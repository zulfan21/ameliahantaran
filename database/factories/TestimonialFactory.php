<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'customer_name' => fake()->name(),
            'rating' => fake()->numberBetween(4, 5),
            'content' => fake()->randomElement([
                'Pelayanan sangat memuaskan, hasil hantaran sangat cantik dan rapi!',
                'Sangat recommended untuk yang mencari hantaran pernikahan berkualitas.',
                'Pengiriman tepat waktu, packaging aman, dan hasilnya memukau!',
                'Harga terjangkau dengan kualitas premium. Terima kasih Amelia Hantaran!',
                'Timnya sangat profesional dan responsif. Hasilnya melebihi ekspektasi!',
            ]),
            'wedding_date' => fake()->date('F Y'),
            'status' => fake()->randomElement(['pending', 'approved']),
            'is_featured' => fake()->boolean(30),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }
}
