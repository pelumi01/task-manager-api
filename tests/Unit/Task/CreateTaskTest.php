<?php

namespace Tests\Unit\Task;

use Tests\TestCase;
use Faker\Factory as Faker;

class CreateTaskTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Test Create Task
    |--------------------------------------------------------------------------
    | This test checks for the successful creation of tasks and checks if the
    | right response is received.
     */
    public function test_create_task(): void
    {
        $faker = Faker::create();

        $response = $this->postJson('/api/tasks', [
            "title" => $faker->sentence,
            "due_date" => $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            "description" => $faker->paragraph,
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
    | Test Create Task Validation
    |--------------------------------------------------------------------------
    | This test checks for when the required payloads are not passed or are
    | not passed in the right format
    */
    public function test_create_task_validation(): void
    {
        $response = $this->postJson('/api/tasks', [
            "title" => "Do the laundry2",
            "due_date" => "2024-06-30",
            "description" => "",
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'Request validation error.']);
    }

    /*
    |--------------------------------------------------------------------------
    | Test If Task Already Exist
    |--------------------------------------------------------------------------
    | This test checks for when the required payloads are not passed or are
    | not passed in the right format
    */
//    public function test_if_task_exist(): void
//    {
//        $response = $this->postJson('/api/tasks', [
//            "title" => "Do the laundry2",
//            "due_date" => "2024-06-30",
//            "description" => "",
//        ]);
//
//        $response->assertStatus(400);
//        $response->assertJsonFragment(['message' => 'Task already exists.']);
//    }
}
