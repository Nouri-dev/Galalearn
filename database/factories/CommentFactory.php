<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Blog;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Choisir un User existant au hasard
        $userId = Student::inRandomOrder()->first()->user_id;

        // Choisir un Blog existant au hasard
        $blogId = Blog::inRandomOrder()->first()->blog_id;

        return [
            'text' => $this->faker->text,
            'user_id' => $userId,
            'blog_id' => $blogId,
            'created_at' => now(),
        ];
    }
}
