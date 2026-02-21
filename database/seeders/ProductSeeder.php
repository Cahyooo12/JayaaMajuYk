<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = base_path('_backup/data/products.json');
        if (!file_exists($jsonPath)) {
            return;
        }

        $products = json_decode(file_get_contents($jsonPath), true);

        foreach ($products as $productData) {
            \App\Models\Product::updateOrCreate(
                ['id' => $productData['id']],
                [
                    'name' => $productData['name'],
                    'category' => $productData['category'],
                    'price' => $productData['price'],
                    'original_price' => $productData['originalPrice'] ?? null,
                    'description' => $productData['description'],
                    'image' => $productData['image'],
                    'images' => $productData['images'] ?? null,
                    'tags' => $productData['tags'] ?? null,
                    'is_ready_stock' => $productData['isReadyStock'] ?? false,
                    'is_best_seller' => $productData['isBestSeller'] ?? false,
                    'specs' => $productData['specs'] ?? null,
                ]
            );
        }
    }
}
