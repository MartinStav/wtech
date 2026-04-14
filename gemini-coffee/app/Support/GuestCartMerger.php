<?php

namespace App\Support;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class GuestCartMerger
{
    private const SESSION_KEY = 'cart';

    /** Merge session guest cart into the user's persisted cart, then clear the session cart. */
    public static function mergeIntoUser(Request $request, User $user): void
    {
        $raw = $request->session()->get(self::SESSION_KEY, []);
        if (! is_array($raw) || $raw === []) {
            return;
        }

        foreach ($raw as $productId => $qty) {
            $productId = (int) $productId;
            $qty = (int) $qty;
            if ($productId < 1 || $qty < 1) {
                continue;
            }

            $product = Product::query()->active()->find($productId);
            if (! $product) {
                continue;
            }

            $existing = CartItem::query()
                ->where('user_id', $user->id)
                ->where('product_id', $productId)
                ->value('quantity');

            $dbQty = (int) ($existing ?? 0);
            $merged = min((int) $product->stock_quantity, $dbQty + $qty);

            if ($merged < 1) {
                continue;
            }

            CartItem::query()->updateOrCreate(
                ['user_id' => $user->id, 'product_id' => $productId],
                ['quantity' => $merged]
            );
        }

        $request->session()->forget(self::SESSION_KEY);
    }
}
