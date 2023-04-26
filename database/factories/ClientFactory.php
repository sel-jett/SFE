<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customerId' => fake()->numberBetween(1,100),
            'username' => fake()->userName(),
            'nom' => fake()->name(),
            'prenom' => fake()->name(),
            'email' => fake()->email(),
            'password' => fake()->password(),
            'currentPayingMethodId' => fake()->numberBetween(0,4),
            'accountActivated' => fake()->boolean()
        ];
    }
}
