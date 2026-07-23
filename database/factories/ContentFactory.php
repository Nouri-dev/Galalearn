<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    protected $model = Content::class;

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
            'status' => $this->faker->boolean,
            'user_id' => $instructorId,
            'category_id' => $categoryId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
