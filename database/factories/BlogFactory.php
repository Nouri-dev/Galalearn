<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

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
        $categoryId = \App\Models\Category::inRandomOrder()->first()->category_id;

        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'url_media' => $this->faker->url,
            'status' => $this->faker->numberBetween(0, 1),
            'category_id' => $categoryId, 
            'user_id' => $instructorId, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

