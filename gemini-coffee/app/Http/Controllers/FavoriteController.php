<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request): RedirectResponse
    {
        $productId = (int) $request->input('product_id', 0);
        Product::findOrFail($productId);

        $user = $request->user();

        $existing = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Favorite::create(['user_id' => $user->id, 'product_id' => $productId]);
        }

        return back();
    }

    public function profile(Request $request): View
    {
        $user = $request->user();

        $favorites = $user->favoriteProducts()
            ->with(['category', 'images'])
            ->latest('favorites.created_at')
            ->get();

        $orders = $user->orders()->with('items')->get();

        return view('src.profile', compact('user', 'favorites', 'orders'));
    }
}
