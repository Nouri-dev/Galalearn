<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'birthdate' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), 
            'email_verified' => $this->faker->boolean(80),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
