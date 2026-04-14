<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
class CheckoutController extends Controller
{
    private const SESSION_KEY = 'checkout';

    public function showShipping(Request $request): View
    {
        $data = array_merge(
            session(self::SESSION_KEY.'.shipping', []),
            old() ?: []
        );

        return view('src.order.shipping', [
            'shipping' => $data,
        ]);
    }

    public function storeShipping(Request $request): RedirectResponse
    {
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

        return view('src.order.payment', [
            'payment' => $data,
        ]);
    }

    public function storePayment(Request $request): RedirectResponse
    {
        if (! $request->session()->has(self::SESSION_KEY.'.shipping')) {
            return redirect('/src/order/shipping.php');
        }

        $digits = preg_replace('/\D/', '', (string) $request->input('card_number', ''));
        $request->merge(['card_number' => $digits]);

        $validated = $request->validate([
            'card_number' => ['required', 'digits_between:13,19'],
            'cardholder' => 'required|string|max:120',
            'expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required', 'digits:3'],
        ], [
            'card_number.digits_between' => 'The card number must contain 13 to 19 digits.',
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

        return view('src.order.review', [
            'shipping' => $request->session()->get(self::SESSION_KEY.'.shipping'),
            'payment' => $request->session()->get(self::SESSION_KEY.'.payment'),
        ]);
    }
}
