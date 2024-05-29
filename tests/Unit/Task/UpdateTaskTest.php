<?php

namespace Tests\Unit\Task;

use Tests\TestCase;
use Faker\Factory as Faker;

class UpdateTaskTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    /*
    |--------------------------------------------------------------------------
    | Test Update Task
    |--------------------------------------------------------------------------
    | This test checks for the successful updating of tasks and checks if the
    | right response is received.
     */
    public function test_update_task(): void
    {
        $faker = Faker::create();

        $response = $this->postJson('/api/tasks', [
            "title" => $faker->sentence,
            "due_date" => $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            "description" => $faker->paragraph,
            "is_completed" => $faker->boolean
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "id",
                "title",
                "due_date",
                "description",
                "is_completed",
                "created_at",
            ]
        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | Test Update Task Validation
    |--------------------------------------------------------------------------
    | This test checks for when the required payloads are not passed or are
    | not passed in the right format
    */
    public function test_update_task_validation(): void
    {
        $response = $this->postJson('/api/tasks', [
            "title" => "Do the laundry2",
            "due_date" => "2024-06-30",
            "description" => "",
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'Request validation error.']);
    }
}
