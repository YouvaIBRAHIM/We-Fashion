<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 80; $i++) {
            $product = Product::inRandomOrder()->first();
            $category = Category::inRandomOrder()->first();

            DB::table('products_catigories')->insert([
                'product_id' => $product->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
