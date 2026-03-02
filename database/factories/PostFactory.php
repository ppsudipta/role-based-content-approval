<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\PostStatus;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->author(), // only author owns post
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),

            // ✅ ENUM SAFE
            'status' => PostStatus::Pending,

            'approved_by' => null,
            'rejected_reason' => null,
        ];
    }

    /**
     * STATES
     */

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => PostStatus::Pending,
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => PostStatus::Approved,
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => PostStatus::Rejected,
        ]);
    }
}