<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 5),
            'date' => fake()->dateTimeBetween('now', '+1 month'),
            'title' => fake()->sentence,
        ];
    }

    // public function forOwner(User $owner)
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'user_id' => $owner->id,
    //     ]);
    // }
}
