<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Response;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentAnswerFactory extends Factory
{
    protected $model = \App\Models\StudentAnswer::class;

    public function definition(): array
    {
        $student = Student::inRandomOrder()->first();
        $question = Question::inRandomOrder()->first();
        $response = Response::where('quiz_id', $question->quiz_id)
                             ->where('question_id', $question->question_id)
                             ->inRandomOrder()
                             ->first();

        return [
            'user_id' => $student->user_id,
            'quiz_id' => $question->quiz_id,
            'question_id' => $question->question_id,
            'response_id' => $response->response_id,
            'created_at' => now(),
        ];
    }
}
