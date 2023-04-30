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
            return [
                'name' => fake()->sentence(3),
                'description' => fake()->paragraph(3),
                'price' => fake()->randomFloat(2, 10, 100),
                'image' => fake()->imageUrl(640, 480, 'products', true),
                'is_visible' => fake()->randomElement([true, false]),
                'state' => fake()->randomElement(['en solde', 'standard']),
                'product_ref' => fake()->unique()->regexify('REF[0-9]{13}'),
                "created_at" => now(),
                "updated_at" => now()
            ];
    }
}
