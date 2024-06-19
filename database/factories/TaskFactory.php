<?php

namespace Database\Factories;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'duedate' => fake()->date(),
            'status' => fake()->randomElement(StatusEnum::toArray()),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
