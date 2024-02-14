<?php

namespace Database\Factories;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'password'    => Hash::make('Password!100'),
            'type'        => RoleType::CUSTOMER->value,
        ];
    }
}
