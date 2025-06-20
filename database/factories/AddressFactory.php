<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cep' => fake()->postcode(),
            'logradouro' => fake()->streetAddress(),
            'bairro' => fake()->city(),
            'cidade' => fake()->city(),
            'estado' => fake()->city(),
        ];
    }
}
