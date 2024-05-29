<?php

namespace Tests\Unit\Task;

use App\Models\Task;
use Tests\TestCase;
use Faker\Factory as Faker;

class FetchSingleTaskTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Test Get Single Task
    |--------------------------------------------------------------------------
    | Tests if a task with the specified id can be retrieved.
    */
    public function test_get_single_tasks(): void
    {
        $faker = Faker::create();

        $task = $this->postJson('/api/tasks', [
            "title" => $faker->sentence,
            "due_date" => $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            "description" => $faker->paragraph,
        ]);

        $task_id = $task['data']['id'];

        $response = $this->get("/api/tasks/$task_id");

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Task request successful']);

    }

    /*
    |--------------------------------------------------------------------------
    | Test Get Single Task
    |--------------------------------------------------------------------------
    | Tests if a task with the specified id can be retrieved.
    */
    public function test_if_task_exist(): void
    {

        $response = $this->get("/api/tasks/10000");

        $response->assertStatus(400);
        $response->assertJsonFragment(['message' => 'Task not found']);

    }
}
