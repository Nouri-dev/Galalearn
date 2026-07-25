<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Instructor;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Response;
use App\Models\Result;
use App\Models\Student;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* Comptes de démonstration */

        $administratorUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username' => 'admin',
                'lastname' => 'Administrator',
                'firstname' => 'Demo',
                'birthdate' => '2000-01-01',
                'password' => 'Password6787',
                'email_verified' => true,
                'status' => 1,
            ]
        );

        Administrator::firstOrCreate([
            'user_id' => $administratorUser->user_id,
        ]);

        Instructor::firstOrCreate([
            'user_id' => $administratorUser->user_id,
        ]);

        Student::firstOrCreate([
            'user_id' => $administratorUser->user_id,
        ]);



        /* Faux utilisateurs */

        $users = User::factory(10)->create();

        $users->each(function ($user) {
            $role = ['instructor', 'student', 'administrator'][rand(0, 2)];

            if ($role === 'instructor') {
                Instructor::create([
                    'user_id' => $user->user_id,
                ]);
            } elseif ($role === 'student') {
                Student::create([
                    'user_id' => $user->user_id,
                ]);
            } else {
                Administrator::create([
                    'user_id' => $user->user_id,
                ]);
            }
        });


        /* Catégories */

        $categories = Category::factory(5)->create();

        $categories->each(function ($category) {
            Category::factory(3)->withParent($category->category_id)->create();
        });


        /*  Quiz / Contenus */

        $quizzes = Quiz::factory(10)->create();

        Content::factory(20)->create();

        $quizzes->each(function ($quiz) {
            Question::factory(5)->create([
                'quiz_id' => $quiz->quiz_id,
            ]);
        });

        Question::with('responses')->each(function ($question) {
            if ($question->responses->isEmpty()) {
                Response::factory(4)->create([
                    'question_id' => $question->question_id,
                    'quiz_id' => $question->quiz_id,
                ]);
            }
        });


        /*  Blog */

        Blog::factory(10)->create();
        Comment::factory(20)->create();


        /*   Résultats */

        $students = Student::pluck('user_id');
        $quizzes = Quiz::pluck('quiz_id');

        DB::transaction(function () use ($students, $quizzes) {

            $existingResults = Result::pluck('quiz_id', 'user_id')
                ->map(function ($quizId, $userId) {
                    return $quizId . '-' . $userId;
                })
                ->toArray();

            $resultsToCreate = [];

            while (count($resultsToCreate) < 15) {

                $quizId = $quizzes->random();
                $userId = $students->random();

                $uniqueIdentifier = $quizId . '-' . $userId;

                if (!in_array($uniqueIdentifier, $existingResults)) {

                    $resultsToCreate[] = [
                        'score' => rand(0, 100),
                        'quiz_id' => $quizId,
                        'user_id' => $userId,
                        'date_completed' => now(),
                        'updated_at' => now(),
                    ];

                    $existingResults[] = $uniqueIdentifier;
                }
            }

            Result::insert($resultsToCreate);
        });


        /*  Réponses des étudiants */

        DB::transaction(function () {

            $studentAnswers = [];
            $uniqueCombinations = collect();

            $maxAttempts = 100;
            $attempts = 0;

            while (count($studentAnswers) < 50 && $attempts < $maxAttempts) {

                $studentAnswer = StudentAnswer::factory()->make();

                $uniqueCombination =
                    $studentAnswer->user_id . '-' .
                    $studentAnswer->quiz_id . '-' .
                    $studentAnswer->question_id . '-' .
                    $studentAnswer->response_id;

                if (!$uniqueCombinations->contains($uniqueCombination)) {

                    $uniqueCombinations->push($uniqueCombination);
                    $studentAnswers[] = $studentAnswer->toArray();
                }

                $attempts++;
            }

            if (!empty($studentAnswers)) {
                StudentAnswer::insert($studentAnswers);
            }
        });
    }
}
