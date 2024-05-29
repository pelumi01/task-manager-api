<?php

namespace Tests\Unit\Task;

use Tests\TestCase;

class FetchAllTaskTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Test Get Tasks
    |--------------------------------------------------------------------------
    | Tests if all tasks can be retrieved.
    */
    public function test_get_tasks(): void
    {
        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Task request successful']);
    }
}
