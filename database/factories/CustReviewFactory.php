<?php

namespace Database\Factories;

use App\Models\CustReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustReview>
 */
class CustReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reviewer_name' => fake()->name(),
            'reviewer_location' => fake()->city(),
            'review' => '<p>'.fake()->sentence(12).'</p>',
            'rating' => fake()->numberBetween(4, 5),
            'is_published' => true,
            'source' => 'Manual',
            'reviewed_at' => fake()->dateTimeBetween('-2 years'),
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes): array => ['is_published' => false]);
    }

    public function google(int $rating = 5): static
    {
        return $this->state(fn (array $attributes): array => ['source' => CustReview::SOURCE_GOOGLE, 'rating' => $rating]);
    }

    public function facebook(): static
    {
        return $this->state(fn (array $attributes): array => ['source' => CustReview::SOURCE_FACEBOOK, 'rating' => 5]);
    }
}
