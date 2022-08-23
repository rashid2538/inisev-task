<?php

namespace Database\Factories;

use App\Enums\PostStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => str($title)->slug(),
            'description' => fake()->paragraph(mt_rand(3, 5)),
            'status' => PostStatusEnum::DRAFT->value,
        ];
    }

    /**
     * Indicate that the model's status should be published.
     *
     * @return static
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => PostStatusEnum::PUBLISHED->value,
            ];
        });
    }

    /**
     * Indicate that the model's status should be trashed.
     *
     * @return static
     */
    public function trashed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => PostStatusEnum::TRASHED->value,
            ];
        });
    }
}
