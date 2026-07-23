<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\Instructor;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Choisir un Instructor existant au hasard
        $instructorId = Instructor::inRandomOrder()->first()->user_id;

        // Choisir une catégorie existante au hasard
        $categoryId = Category::inRandomOrder()->first()->category_id;

        return [
            'title' => $this->faker->sentence,
            'status' => $this->faker->boolean,
            'category_id' => $categoryId,
            'user_id' => $instructorId,  
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
