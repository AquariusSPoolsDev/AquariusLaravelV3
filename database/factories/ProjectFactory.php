<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(3, true).' Pool',
            'location' => fake()->city(),
            'description' => fake()->paragraph(),
            'year_completed' => fake()->numberBetween(1995, 2026),
            'tags' => ['Residential'],
            'is_published' => false,
            'sort_order' => 0,
        ];
    }

    /**
     * A project that shows on the public site.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes): array => ['is_published' => true]);
    }
}
