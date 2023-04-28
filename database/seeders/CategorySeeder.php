<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            "name" => "Femme",
            "slug" => "femme",
            "created_at" => now(),
            "updated_at" => now()
        ]);
        DB::table('categories')->insert([
            "name" => "Homme",
            "slug" => "homme",
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
