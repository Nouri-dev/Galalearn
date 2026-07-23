<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Choisir un Administrator existant au hasard
        $administratorId = Administrator::inRandomOrder()->first()->user_id;

        return [
            'name' => $this->faker->word,
            'parent_category_id' => null, // Par défaut, pas de catégorie parent
            'user_id' => $administratorId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indique que la catégorie a un parent.
     *
     * @param  int  $parentId
     * @return static
     */
    public function withParent(int $parentId): static
    {
        return $this->state([
            'parent_category_id' => $parentId,
        ]);
    }
}
