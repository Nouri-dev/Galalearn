<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Choisir un Quiz existant au hasard
        $quizId = Quiz::inRandomOrder()->first()->quiz_id;

        // Choisir un Instructor existant au hasard
        $instructorId = Instructor::inRandomOrder()->first()->user_id;

        return [
            'text' => $this->faker->paragraph,
            'quiz_id' => $quizId, 
            'user_id' => $instructorId, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
