<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            "XS",
            "S",
            "M",
            "L",
            "XL"
        ];
        foreach ($sizes as $size) {
            DB::table('product_sizes')->insert([
                "size" => $size,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
