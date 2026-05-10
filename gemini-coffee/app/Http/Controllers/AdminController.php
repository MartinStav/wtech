<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with(['category', 'images'])
            ->orderBy('id')
            ->paginate(20);

        return view('src.admin.dashboard', ['products' => $products]);
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('src.admin.product-add', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'origin_label'   => 'nullable|string|max:120',
            'roast_level'    => 'required|in:light,medium,dark',
            'weight_grams'   => 'required|integer|min:1',
            'description'    => 'nullable|string',
            'stock_quantity' => 'nullable|integer|min:0',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $product = Product::query()->create([
            'category_id'    => $validated['category_id'],
            'name'           => $validated['name'],
            'slug'           => $this->uniqueSlug($validated['name']),
            'description'    => $validated['description'] ?? '',
            'price'          => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'] ?? 100,
            'is_active'      => true,
            'origin_label'   => $validated['origin_label'] ?? null,
            'roast_level'    => $validated['roast_level'],
            'weight_grams'   => (int) $validated['weight_grams'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('products', 'public');
                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'path'       => 'storage/'.$path,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')
            ->with('status', 'Product "'.$product->name.'" created successfully.');
    }

    public function edit(Request $request): View
    {
        $id = (int) $request->query('id', 0);
        $product = Product::query()->with(['category', 'images'])->findOrFail($id);
        $categories = Category::all();

        return view('src.admin.product-edit', [
            'product'    => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $id = (int) $request->query('id', 0);
        $product = Product::query()->with('images')->findOrFail($id);

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'price'          => 'required|numeric|min:0',
            'origin_label'   => 'nullable|string|max:120',
            'roast_level'    => 'required|in:light,medium,dark',
            'weight_grams'   => 'required|integer|min:1',
            'description'    => 'nullable|string',
            'stock_quantity' => 'nullable|integer|min:0',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'remove_images'  => 'nullable|array',
            'remove_images.*'=> 'integer',
        ]);

        $product->update([
            'category_id'    => $validated['category_id'],
            'name'           => $validated['name'],
            'description'    => $validated['description'] ?? '',
            'price'          => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'] ?? $product->stock_quantity,
            'origin_label'   => $validated['origin_label'] ?? null,
            'roast_level'    => $validated['roast_level'],
            'weight_grams'   => (int) $validated['weight_grams'],
        ]);

        if (!empty($validated['remove_images'])) {
            $toRemove = $product->images->whereIn('id', $validated['remove_images']);
            foreach ($toRemove as $img) {
                if (str_starts_with($img->path, 'storage/')) {
                    Storage::disk('public')->delete(substr($img->path, 8));
                }
                $img->delete();
            }
        }

        if ($request->hasFile('images')) {
            $nextOrder = ($product->images->max('sort_order') ?? -1) + 1;
            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('products', 'public');
                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'path'       => 'storage/'.$path,
                    'sort_order' => $nextOrder + $i,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')
            ->with('status', 'Product "'.$product->name.'" updated successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $id = (int) $request->input('id', 0);
        $product = Product::query()->with('images')->findOrFail($id);

        foreach ($product->images as $img) {
            if (str_starts_with($img->path, 'storage/')) {
                Storage::disk('public')->delete(substr($img->path, 8));
            }
        }

        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.dashboard')
            ->with('status', 'Product "'.$name.'" deleted.');
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (Product::query()->where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
