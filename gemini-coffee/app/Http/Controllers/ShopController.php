<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    /** @var array<string, string> */
    private const ORIGIN_SLUGS = [
        'brazil' => 'Brazil',
        'colombia' => 'Colombia',
        'ethiopia' => 'Ethiopia',
        'indonesia' => 'Indonesia',
        'multiple' => 'Multiple',
        'costa-rica' => 'Costa Rica',
        'guatemala' => 'Guatemala',
    ];

    public function index(Request $request): View
    {
        $perPage = 6;
        $query = Product::query()
            ->with(['category', 'images'])
            ->active();

        if ($search = trim((string) $request->query('q', ''))) {
            $like = '%'.Str::lower($search).'%';
            $query->where(function ($q) use ($like) {
                $q->whereRaw('LOWER(name) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(description) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(COALESCE(origin_label, \'\')) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(roast_level) LIKE ?', [$like])
                    ->orWhereHas('category', function ($cq) use ($like) {
                        $cq->whereRaw('LOWER(name) LIKE ?', [$like]);
                    });
            });
        }

        $category = (string) $request->query('category', '');
        if ($category !== '' && $category !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $category));
        }

        $roast = (string) $request->query('roast', '');
        if ($roast !== '' && $roast !== 'all') {
            $query->where('roast_level', $roast);
        }

        $origin = (string) $request->query('origin', '');
        if ($origin !== '' && $origin !== 'all') {
            $label = self::ORIGIN_SLUGS[$origin] ?? null;
            if ($label !== null) {
                $query->where('origin_label', $label);
            }
        }

        $sort = (string) $request->query('sort', 'price_asc');
        match ($sort) {
            'price_desc' => $query->orderByDesc('price')->orderBy('name'),
            'name' => $query->orderBy('name'),
            default => $query->orderBy('price')->orderBy('name'),
        };

        $products = $query->paginate($perPage)->withQueryString();

        return view('src.public.shop', [
            'products' => $products,
        ]);
    }

    public function show(Request $request): View
    {
        $id = (int) $request->query('id', 0);
        $product = Product::query()
            ->with(['category', 'images'])
            ->active()
            ->findOrFail($id);

        return view('src.public.product', [
            'product' => $product,
        ]);
    }
}
