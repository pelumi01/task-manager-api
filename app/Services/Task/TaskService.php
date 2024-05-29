<?php
namespace App\Services\Task;

use App\Http\Resources\Task\TaskCollection;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use PHPUnit\Exception;
use function tap;

class TaskService
{
    private string $id;
    private string $title;
    private string $dueDate;
    private bool $isCompleted;
    private string $description;

    public function setId( string $id) {
        $this->id = $id;
        return $this;
    }

    public function setTitle( string $title) {
        $this->title = $title;
        return $this;
    }

    public function setDueDate( string $due_date) {
        $this->dueDate = $due_date;
        return $this;
    }

    public function setDescription( string $description) {
        $this->description = $description;
        return $this;
    }

    public function setIsCompleted( bool $is_completed) {
        $this->isCompleted = $is_completed;
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Create Task
    |--------------------------------------------------------------------------
    */
    public function create() {
        try {
            // get task with the title
            $task = Task::where('title', $this->title)->first();

            // check if the task already exist
            if ($task)
                throw new \Exception("Task already exist", 400);

            // create task
            $task = Task::create([
                'title' => $this->title,
                'due_date' => $this->dueDate,
                'description' => $this->description,
            ]);

            // return response
            return [
                "code" => 200,
                "message" => "Task created successfully",
                "data" => TaskResource::make($task),
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update Task
    |--------------------------------------------------------------------------
    */
    public function update() {
        try {
            // get task with the title
            $task = Task::where('id', $this->id)->first();

            // check if task is does not exist and throw an error
            if (!$task)
                throw new \Exception("Task not found", 400);

            // update task
            $task = tap($task)->update([
                'title' => $this->title,
                'due_date' => $this->dueDate,
                'description' => $this->description,
                'is_completed' => $this->isCompleted,
            ]);

            // return response
            return [
                "code" => 200,
                "message" => "Task updates successfully",
                "data" => TaskResource::make($task),
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Get Tasks
    |--------------------------------------------------------------------------
    */
    public function tasks() {
        try {
            // get all task
            $tasks = Task::orderBy('created_at', 'desc')->paginate(10);

            // return response
            return [
                "code" => 200,
                "message" => "Task request successful",
                "data" => new TaskCollection($tasks),
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Get Task
    |--------------------------------------------------------------------------
    */
    public function task() {
        try {
            // get task with the particular id
            $task = Task::where('id', $this->id)->first();

            // check if task does not exist and throw an error
            if (!$task)
                throw new \Exception("Task not found", 400);

            // return response
            return [
                "code" => 200,
                "message" => "Task deleted successfully",
                "data" => TaskResource::make($task),
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Delete Task
    |--------------------------------------------------------------------------
    */
    public function delete() {
        try {
            // get task with the particular id
            $task = Task::where('id', $this->id)->first();

            // check if task does not exist and throw an error
            if (!$task)
                throw new \Exception("Task not found", 400);

            // delete task
            $task->delete();

            // return response
            return [
                "code" => 200,
                "message" => "Task deleted successfully",
                "data" => [],
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }
}
