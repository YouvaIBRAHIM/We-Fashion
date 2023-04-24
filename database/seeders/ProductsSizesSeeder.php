<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 250; $i++) {
            $product = Product::inRandomOrder()->first();
            $productSize = ProductSize::inRandomOrder()->first();

            // on vérifie d'abord si le produit possède déjà la taille dans la table products_product_sizes
            $isLineAlreadyExist = DB::table('products_product_sizes')
                                        ->where("product_id", $product->id)
                                        ->where('product_size_id', $productSize->id)
                                        ->first();
            if (!$isLineAlreadyExist) {
                DB::table('products_product_sizes')->insert([
                    'product_id' => $product->id,
                    'product_size_id' => $productSize->id,
                ]);
            }
        }
    }
}
