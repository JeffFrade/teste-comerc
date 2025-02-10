<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
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
        $phone = StringHelper::replaceRegex($this->faker->phoneNumber(), '/[\D]/i', '');

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $phone,
            'birth_date' => $this->faker->date(),
            'cep' => random_int(11111111, 99999999),
            'address' => $this->faker->address(),
            'number' => random_int(1, 35000),
            'complement' => rand(0, 1) ? $this->faker->word() : null,
            'neighborhood' => $this->faker->city()
        ];
    }
}
