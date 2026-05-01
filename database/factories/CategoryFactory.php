<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Hantaran Seserahan',
            'Kotak Hantaran',
            'Bunga Artificial',
            'Aksesoris Pernikahan',
            'Parcel Lebaran',
            'Hampers',
            'Dekorasi',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'icon' => 'gift',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
