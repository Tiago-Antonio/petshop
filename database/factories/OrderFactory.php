<?php

namespace Database\Factories;

use App\Models\User; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id'=> $this->faker->numberBetween(1, 20),
            'user_id' => User::inRandomOrder()->first()?->id ?? 1, 
            'payment_id' => $this->faker->numberBetween(1, 4), 
            'status' => $this->faker->randomElement(['pendente', 'finalizado', 'cancelado']),
            'total_amount' => $this->faker->randomFloat(2, 10, 500),
            'created_at' => now(),
        ];
    }
}
