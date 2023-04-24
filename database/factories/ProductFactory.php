<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return Factory::define(Product::class, function (Faker $faker) {
            return [
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 10, 100),
                'image' => $faker->imageUrl(640, 480, 'products', true),
                'is_visible' => true,
                'state' => $faker->randomElement(['en solde', 'standard']),
                'product_ref' => $faker->unique()->regexify('[A-Za-z0-9]{16}')
            ];
        });
    }
}
