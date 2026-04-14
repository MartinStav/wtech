<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Support\CartContents;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private const SESSION_KEY = 'cart';

    /** @return array<int, int> product_id => quantity */
    private function lines(Request $request): array
    {
        return CartContents::lines($request);
    }

    private function saveLines(Request $request, array $lines): void
    {
        if (Auth::check()) {
            $userId = (int) Auth::id();
            DB::transaction(function () use ($userId, $lines): void {
                CartItem::query()->where('user_id', $userId)->delete();
                foreach ($lines as $productId => $qty) {
                    $qty = (int) $qty;
                    if ($qty < 1) {
                        continue;
                    }
                    CartItem::query()->create([
                        'user_id' => $userId,
                        'product_id' => (int) $productId,
                        'quantity' => $qty,
                    ]);
                }
            });

            return;
        }

        $request->session()->put(self::SESSION_KEY, $lines);
    }

    public function index(Request $request): View
    {
        $lines = $this->lines($request);
        if ($lines === []) {
            return view('src.order.basket-empty');
        }

        $built = CartContents::rowsAndSubtotal($request);
        $cartRows = $built['cartRows'];
        $subtotal = $built['subtotal'];

        if ($cartRows->isEmpty()) {
            $this->saveLines($request, []);

            return view('src.order.basket-empty');
        }

        return view('src.order.basket', [
            'cartRows' => $cartRows,
            'subtotal' => $subtotal,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:999'],
        ]);

        $quantity = (int) ($data['quantity'] ?? 1);
        $product = Product::query()->active()->findOrFail((int) $data['product_id']);

        $lines = $this->lines($request);
        $existing = $lines[$product->id] ?? 0;
        if ($existing + $quantity > (int) $product->stock_quantity) {
            return back()
                ->withErrors(['quantity' => 'Not enough stock for '.$product->name.'.'])
                ->withInput();
        }

        $lines[$product->id] = ($lines[$product->id] ?? 0) + $quantity;
        $this->saveLines($request, $lines);

        if ($request->boolean('checkout')) {
            return redirect(url('/src/order/shipping.php'));
        }

        return redirect()
            ->route('cart.index')
            ->with('status', 'Added to cart.');
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:0', 'max:999'],
        ]);

        $productId = (int) $data['product_id'];
        $quantity = (int) $data['quantity'];
        $lines = $this->lines($request);

        if ($quantity === 0) {
            unset($lines[$productId]);
            $this->saveLines($request, $lines);

            return redirect()->route('cart.index');
        }

        $product = Product::query()->active()->findOrFail($productId);
        if ($quantity > (int) $product->stock_quantity) {
            return back()
                ->withErrors(['quantity' => 'Not enough stock for '.$product->name.'.'])
                ->withInput();
        }

        $lines[$productId] = $quantity;
        $this->saveLines($request, $lines);

        return redirect()->route('cart.index');
    }

    public function remove(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $lines = $this->lines($request);
        unset($lines[(int) $data['product_id']]);
        $this->saveLines($request, $lines);

        return redirect()->route('cart.index');
    }

    public function clear(Request $request): RedirectResponse
    {
        CartContents::clearAll($request);

        return redirect()->route('cart.index');
    }
}
