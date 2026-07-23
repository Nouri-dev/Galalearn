<?php 

use App\Models\Quiz;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    protected $model = Result::class;

    public function definition()
    {
        $quizIds = Quiz::pluck('quiz_id');
        $userIds = Student::pluck('user_id');

        $quizId = $this->faker->randomElement($quizIds);
        $userId = $this->faker->randomElement($userIds);

        return [
            'score' => $this->faker->numberBetween(0, 100),
            'quiz_id' => $quizId,
            'user_id' => $userId,
            'date_completed' => now(),
            'updated_at' => now(),
        ];
    }
}
