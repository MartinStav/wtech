<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class CoffeeCatalogSeeder extends Seeder
{
    public function run(): void
    {
        ProductImage::query()->delete();
        Product::query()->delete();
        Category::query()->delete();

        $singleOrigin = Category::query()->create([
            'name' => 'Single Origin',
            'slug' => 'single-origin',
        ]);
        $blend = Category::query()->create([
            'name' => 'Blend',
            'slug' => 'blend',
        ]);
        $decaf = Category::query()->create([
            'name' => 'Decaf',
            'slug' => 'decaf',
        ]);

        $rows = [
            [
                'category' => $singleOrigin,
                'name' => 'Brazilian Santos',
                'slug' => 'brazilian-santos',
                'description' => 'Mild and sweet with nutty undertones. Low acidity and smooth finish.',
                'price' => 15.99,
                'origin_label' => 'Brazil',
                'roast_level' => 'medium',
                'images' => [
                    'assets/brazilian.png',
                    'assets/brazilianIG.png',
                    'assets/columbian_supremo.png',
                    'assets/costaIG.png',
                ],
            ],
            [
                'category' => $singleOrigin,
                'name' => 'Colombian Supremo',
                'slug' => 'colombian-supremo',
                'description' => 'Balanced cup with caramel sweetness and a clean citrus finish.',
                'price' => 16.99,
                'origin_label' => 'Colombia',
                'roast_level' => 'medium',
                'images' => ['assets/columbian_supremo.png', 'assets/columbianIG.png'],
            ],
            [
                'category' => $singleOrigin,
                'name' => 'Ethiopian Yirgacheffe',
                'slug' => 'ethiopian-yirgacheffe',
                'description' => 'Floral aroma, bright acidity, and tea-like body typical of washed Yirgacheffe.',
                'price' => 18.99,
                'origin_label' => 'Ethiopia',
                'roast_level' => 'light',
                'images' => ['assets/ethiopian_1.png', 'assets/ethiopianIG.png'],
            ],
            [
                'category' => $singleOrigin,
                'name' => 'Costa Rican Tarrazu',
                'slug' => 'costa-rican-tarrazu',
                'description' => 'Crisp acidity, honey sweetness, and milk chocolate notes.',
                'price' => 18.99,
                'origin_label' => 'Costa Rica',
                'roast_level' => 'medium',
                'images' => ['assets/costarica.png', 'assets/costaIG.png'],
            ],
            [
                'category' => $decaf,
                'name' => 'Decaf Colombia',
                'slug' => 'decaf-colombia',
                'description' => 'Swiss-water decaf preserving sweetness and body without caffeine.',
                'price' => 17.99,
                'origin_label' => 'Colombia',
                'roast_level' => 'medium',
                'images' => ['assets/decaf.png', 'assets/decafIG.png'],
            ],
            [
                'category' => $blend,
                'name' => 'Espresso Blend',
                'slug' => 'espresso-blend',
                'description' => 'Bold dark roast built for rich crema and chocolate-forward espresso.',
                'price' => 19.99,
                'origin_label' => 'Multiple',
                'roast_level' => 'dark',
                'images' => ['assets/espresso_blend.png', 'assets/espressoIG.png'],
            ],
            [
                'category' => $singleOrigin,
                'name' => 'Guatemala Antigua Reserve',
                'slug' => 'guatemala-antigua-reserve',
                'description' => 'Cocoa, spice, and stone fruit with a velvety mouthfeel.',
                'price' => 18.99,
                'origin_label' => 'Guatemala',
                'roast_level' => 'medium',
                'images' => ['assets/guatemala.png'],
            ],
            [
                'category' => $singleOrigin,
                'name' => 'Sumatra Mandheling',
                'slug' => 'sumatra-mandheling',
                'description' => 'Full body, low acidity, earthy and herbal with dark chocolate depth.',
                'price' => 19.99,
                'origin_label' => 'Indonesia',
                'roast_level' => 'medium',
                'images' => ['assets/sumatra_mandheling.png'],
            ],
        ];

        foreach ($rows as $row) {
            /** @var Category $cat */
            $cat = $row['category'];
            $product = Product::query()->create([
                'category_id' => $cat->id,
                'name' => $row['name'],
                'slug' => $row['slug'],
                'description' => $row['description'],
                'price' => $row['price'],
                'stock_quantity' => 100,
                'is_active' => true,
                'origin_label' => $row['origin_label'],
                'roast_level' => $row['roast_level'],
                'weight_grams' => 250,
            ]);
            foreach ($row['images'] as $i => $path) {
                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'path' => $path,
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
