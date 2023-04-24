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
        for ($i = 1; $i <= 120; $i++) {
            $product = Product::inRandomOrder()->first();
            $category = Category::inRandomOrder()->first();
            // on vérifie d'abord si le produit possède déjà la catégorie dans la table products_catigories
            $isLineAlreadyExist = DB::table('products_catigories')
                                        ->where("product_id", $product->id)
                                        ->where('category_id', $category->id)
                                        ->first();

            if (!$isLineAlreadyExist) {
                DB::table('products_catigories')->insert([
                    'product_id' => $product->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
