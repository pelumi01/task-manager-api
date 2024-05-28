<?php
namespace App\Services;

use App\Models\Task;
use PHPUnit\Exception;

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

    public function create() {
        try {
            $task = Task::where('title', $this->title)->first();

            if ($task)
                throw new \Exception("Task already exist", 400);

            $task = Task::create([
                'title' => $this->title,
                'due_date' => $this->dueDate,
                'description' => $this->description,
            ]);

            return [
                "code" => 200,
                "message" => "Task created successfully",
                "data" => $task,
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function update() {
        try {
            $task = Task::where('id', $this->id)->first();

            if (!$task)
                throw new \Exception("Task not found", 400);

            $task = tap($task)->update([
                'title' => $this->title,
                'due_date' => $this->dueDate,
                'description' => $this->description,
                'is_completed' => $this->isCompleted,
            ]);

            return [
                "code" => 200,
                "message" => "Task updates successfully",
                "data" => $task,
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }

    public function tasks() {
        try {
            $tasks = Task::all();

            return [
                "code" => 200,
                "message" => "Task request successful",
                "data" => $tasks,
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }

    public function task() {
        try {
            $task = Task::where('id', $this->id)->first();

            if (!$task)
                throw new \Exception("Task not found", 400);

            return [
                "code" => 200,
                "message" => "Task deleted successfully",
                "data" => $task,
            ];
        }
        catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

    }

    public function delete() {
        try {
            $task = Task::where('id', $this->id)->first();

            if (!$task)
                throw new \Exception("Task not found", 400);

            $task->delete();

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
