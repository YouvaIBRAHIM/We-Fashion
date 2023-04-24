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
        DB::table('product_sizes')->insert(["size" => "XS"]);
        DB::table('product_sizes')->insert(["size" => "S"]);
        DB::table('product_sizes')->insert(["size" => "M"]);
        DB::table('product_sizes')->insert(["size" => "L"]);
        DB::table('product_sizes')->insert(["size" => "XL"]);
    }
}
