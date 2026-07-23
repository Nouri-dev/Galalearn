<?php

namespace Database\Factories;

use App\Models\Response;
use App\Models\Question;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    protected $model = Response::class;

    public function definition(): array
    {
        $question = Question::inRandomOrder()->first();
        $instructor = Instructor::inRandomOrder()->first();

        return [
            'text' => $this->faker->paragraph,
            'is_correct' => $this->faker->boolean,
            'quiz_id' => $question->quiz_id,
            'question_id' => $question->question_id,
            'user_id' => $instructor->user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
