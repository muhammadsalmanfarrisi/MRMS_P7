<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'skill' => fake()->jobTitle(),
            // 80% kemungkinan punya nomor HP, 20% null
            'phone_number' => fake()->boolean(80) ? fake()->phoneNumber() : null,
            // 70% kemungkinan punya telegram, 30% null
            'telegram_username' => fake()->boolean(70) ? '@' . fake()->userName() : null,
        ];
    }
}
