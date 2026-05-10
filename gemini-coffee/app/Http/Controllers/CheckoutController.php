<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Support\CartContents;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private const SESSION_KEY = 'checkout';

    /**
     * @return array{cartRows: \Illuminate\Support\Collection, subtotal: float, shippingFee: float, tax: float, total: float}|RedirectResponse
     */
    private function orderSummary(Request $request, string $shippingMethod): array|RedirectResponse
    {
        $built = CartContents::rowsAndSubtotal($request);
        if ($built['cartRows']->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('checkout_error', 'Your cart is empty.');
        }

        $shippingFee = CartContents::shippingEuros($shippingMethod);
        $taxTotal = CartContents::taxAndTotal($built['subtotal'], $shippingFee);

        return [
            'cartRows' => $built['cartRows'],
            'subtotal' => $built['subtotal'],
            'shippingFee' => $shippingFee,
            'tax' => $taxTotal['tax'],
            'total' => $taxTotal['total'],
        ];
    }

    public function showShipping(Request $request): View|RedirectResponse
    {
        $saved = session(self::SESSION_KEY.'.shipping', []);
        $data = array_merge($saved, old() ?: []);

        $savedAddress = null;
        if (auth()->check() && empty($saved)) {
            $savedAddress = auth()->user()->addresses()->where('is_default', true)->first()
                ?? auth()->user()->addresses()->latest()->first();
            if ($savedAddress && empty($data)) {
                $data = [
                    'first_name' => $savedAddress->first_name,
                    'last_name'  => $savedAddress->last_name,
                    'email'      => $savedAddress->email,
                    'address'    => $savedAddress->address_line,
                    'city'       => $savedAddress->city,
                    'state'      => $savedAddress->state,
                    'zip'        => $savedAddress->postal_code,
                ];
            }
        }

        $shippingMethod = $data['shipping_method'] ?? 'standard';
        $summary = $this->orderSummary($request, $shippingMethod);
        if ($summary instanceof RedirectResponse) {
            return $summary;
        }

        return view('src.order.shipping', [
            'shipping'     => $data,
            'savedAddress' => $savedAddress,
            ...$summary,
        ]);
    }

    public function storeShipping(Request $request): RedirectResponse
    {
        if (CartContents::rowsAndSubtotal($request)['cartRows']->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('checkout_error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'shipping_method' => 'required|in:standard,express,overnight',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/',
            ],
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => ['required', 'string', 'regex:/^\d{4,10}$/'],
        ], [
            'email.regex' => 'The email must include a domain with an extension (for example .com or .sk).',
            'zip.regex' => 'The zip code may only contain digits.',
        ]);

        if (auth()->check() && $request->boolean('save_address')) {
            $user = auth()->user();
            $hasDefault = $user->addresses()->where('is_default', true)->exists();

            $user->addresses()->create([
                'first_name'   => $validated['first_name'],
                'last_name'    => $validated['last_name'],
                'email'        => $validated['email'],
                'address_line' => $validated['address'],
                'city'         => $validated['city'],
                'state'        => $validated['state'],
                'postal_code'  => $validated['zip'],
                'is_default'   => ! $hasDefault,
            ]);
        }

        $request->session()->put(self::SESSION_KEY.'.shipping', $validated);

        return redirect('/src/order/payment.php');
    }

    public function showPayment(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has(self::SESSION_KEY.'.shipping')) {
            return redirect('/src/order/shipping.php')
                ->with('checkout_error', 'Please complete shipping details first.');
        }

        $data = array_merge(
            session(self::SESSION_KEY.'.payment', []),
            old() ?: []
        );

        $shippingMethod = (string) $request->session()->get(self::SESSION_KEY.'.shipping.shipping_method', 'standard');
        $summary = $this->orderSummary($request, $shippingMethod);
        if ($summary instanceof RedirectResponse) {
            return $summary;
        }

        return view('src.order.payment', [
            'payment' => $data,
            ...$summary,
        ]);
    }

    public function storePayment(Request $request): RedirectResponse
    {
        if (! $request->session()->has(self::SESSION_KEY.'.shipping')) {
            return redirect('/src/order/shipping.php');
        }

        if (CartContents::rowsAndSubtotal($request)['cartRows']->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('checkout_error', 'Your cart is empty.');
        }

        $digits = preg_replace('/\D/', '', (string) $request->input('card_number', ''));
        $request->merge(['card_number' => $digits]);

        $validated = $request->validate([
            'card_number' => ['required', 'digits:16'],
            'cardholder' => 'required|string|max:120',
            'expiry' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/\d{2}$/',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^(0[1-9]|1[0-2])\/(\d{2})$/', $value, $m)) {
                        $cardYear  = 2000 + (int) $m[2];
                        $cardMonth = (int) $m[1];
                        $now = now();
                        if ($cardYear < $now->year || ($cardYear === $now->year && $cardMonth < $now->month)) {
                            $fail('The expiry date must not be in the past.');
                        }
                    }
                },
            ],
            'cvv' => ['required', 'digits:3'],
        ], [
            'card_number.digits' => 'The card number must contain exactly 16 digits.',
            'expiry.regex' => 'The expiry must be in MM/YY format.',
        ]);

        $request->session()->put(self::SESSION_KEY.'.payment', $validated);

        return redirect('/src/order/review.php');
    }

    public function showReview(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has(self::SESSION_KEY.'.shipping')) {
            return redirect('/src/order/shipping.php');
        }
        if (! $request->session()->has(self::SESSION_KEY.'.payment')) {
            return redirect('/src/order/payment.php');
        }

        $shippingMethod = (string) $request->session()->get(self::SESSION_KEY.'.shipping.shipping_method', 'standard');
        $summary = $this->orderSummary($request, $shippingMethod);
        if ($summary instanceof RedirectResponse) {
            return $summary;
        }

        return view('src.order.review', [
            'shipping' => $request->session()->get(self::SESSION_KEY.'.shipping'),
            'payment' => $request->session()->get(self::SESSION_KEY.'.payment'),
            ...$summary,
        ]);
    }

    public function completeOrder(Request $request): RedirectResponse
    {
        if (! $request->session()->has(self::SESSION_KEY.'.shipping')
            || ! $request->session()->has(self::SESSION_KEY.'.payment')) {
            return redirect('/src/order/shipping.php')
                ->with('checkout_error', 'Your checkout session expired. Please start again.');
        }

        $built = CartContents::rowsAndSubtotal($request);

        if ($built['cartRows']->isEmpty()) {
            $request->session()->forget(self::SESSION_KEY);

            return redirect()
                ->route('cart.index')
                ->with('checkout_error', 'Your cart is empty.');
        }

        $shipping = $request->session()->get(self::SESSION_KEY.'.shipping');
        $shippingFee = CartContents::shippingEuros($shipping['shipping_method']);
        $taxTotal = CartContents::taxAndTotal($built['subtotal'], $shippingFee);

        $order = Order::create([
            'user_id'        => auth()->id(),
            'first_name'     => $shipping['first_name'],
            'last_name'      => $shipping['last_name'],
            'email'          => $shipping['email'],
            'address_line'   => $shipping['address'],
            'city'           => $shipping['city'],
            'state'          => $shipping['state'],
            'postal_code'    => $shipping['zip'],
            'shipping_method' => $shipping['shipping_method'],
            'shipping_price' => $shippingFee,
            'subtotal'       => $built['subtotal'],
            'tax'            => $taxTotal['tax'],
            'total'          => $taxTotal['total'],
            'status'         => 'placed',
        ]);

        foreach ($built['cartRows'] as $row) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $row->product->id,
                'product_name' => $row->product->name,
                'unit_price'   => $row->product->price,
                'quantity'     => $row->quantity,
                'line_total'   => $row->line_total,
            ]);
        }

        CartContents::clearAll($request);
        $request->session()->forget(self::SESSION_KEY);

        return redirect(url('/home.php'))->with('order_placed', true);
    }
}
