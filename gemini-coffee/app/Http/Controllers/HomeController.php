<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredProducts = Product::query()
            ->with(['category', 'images'])
            ->active()
            ->orderBy('id')
            ->limit(5)
            ->get();

        return view('home', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
