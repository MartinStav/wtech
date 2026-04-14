<?php

namespace App\Support;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartContents
{
    private const SESSION_KEY = 'cart';

    /** @return array<int, int> product_id => quantity */
    public static function lines(Request $request): array
    {
        if (Auth::check()) {
            return CartItem::query()
                ->where('user_id', Auth::id())
                ->pluck('quantity', 'product_id')
                ->map(fn ($q) => (int) $q)
                ->all();
        }

        $raw = $request->session()->get(self::SESSION_KEY, []);

        return is_array($raw) ? array_map('intval', $raw) : [];
    }

    /**
     * @return array{cartRows: Collection<int, object{product: Product, quantity: int, line_total: float}>, subtotal: float}
     */
    public static function rowsAndSubtotal(Request $request): array
    {
        $lines = self::lines($request);
        if ($lines === []) {
            return ['cartRows' => new Collection, 'subtotal' => 0.0];
        }

        $products = Product::query()
            ->with(['category', 'images'])
            ->active()
            ->whereIn('id', array_keys($lines))
            ->get()
            ->keyBy('id');

        $cartRows = new Collection;
        $subtotal = 0.0;
        foreach ($lines as $productId => $qty) {
            $product = $products->get($productId);
            if (! $product || $qty < 1) {
                continue;
            }
            $lineTotal = (float) $product->price * $qty;
            $subtotal += $lineTotal;
            $cartRows->push((object) [
                'product' => $product,
                'quantity' => $qty,
                'line_total' => $lineTotal,
            ]);
        }

        return ['cartRows' => $cartRows, 'subtotal' => $subtotal];
    }

    public static function shippingEuros(?string $method): float
    {
        return match ($method) {
            'express' => 15.0,
            'overnight' => 25.0,
            default => 5.0,
        };
    }

    /** VAT 20 % on subtotal + shipping (demo shop). */
    public static function taxAndTotal(float $subtotal, float $shippingFee): array
    {
        $tax = round(($subtotal + $shippingFee) * 0.20, 2);
        $total = round($subtotal + $shippingFee + $tax, 2);

        return ['tax' => $tax, 'total' => $total];
    }

    /** Remove all cart lines (database for users, session for guests). */
    public static function clearAll(Request $request): void
    {
        if (Auth::check()) {
            CartItem::query()->where('user_id', Auth::id())->delete();

            return;
        }

        $request->session()->forget(self::SESSION_KEY);
    }
}
