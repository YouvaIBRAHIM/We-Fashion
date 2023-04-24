<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $category = Category::inRandomOrder()->first();

            DB::table('products_catigories')->insert([
                'product_id' => $product->id,
                'category_id' => $category->id,
            ]);
            
            // affectation d'une image aléatoire pour le produit selon sa catégorie
            if ($category->name == "Homme") {
                $menFolder = '/public/products_images/hommes';
                
                $images = Storage::files($menFolder);
            }else if($category->name == "Femme") {
                $womenFolder = '/public/products_images/femmes';
                $images = Storage::files($womenFolder);
            }

            $image = $images[array_rand($images)];

            $product->update([
                "image" => $image
            ]);
        }
    }
}
