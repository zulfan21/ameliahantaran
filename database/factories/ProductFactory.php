<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Luxury White',
            'Crystal Double',
            'Ring Box',
            'Gold Elegance',
            'Pink Romance',
            'Classic Brown',
            'Modern Minimalist',
            'Royal Purple',
            'Vintage Cream',
            'Rose Gold',
        ]) . ' ' . fake()->randomElement(['Series', 'Collection', 'Set', 'Package']);

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomElement([50000, 75000, 100000, 150000, 200000, 250000, 300000]),
            'stock' => fake()->numberBetween(5, 50),
            'min_order' => 1,
            'main_image' => 'products/default.jpg',
            'specifications' => json_encode([
                'Material' => fake()->randomElement(['Kayu Jati', 'MDF', 'Akrilik', 'Rotan']),
                'Ukuran' => fake()->randomElement(['30x30 cm', '40x40 cm', '50x50 cm']),
                'Warna' => fake()->randomElement(['Putih', 'Cream', 'Pink', 'Gold']),
                'Berat' => fake()->randomElement(['1 kg', '2 kg', '3 kg']),
            ]),
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
            'view_count' => fake()->numberBetween(0, 1000),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }
}
