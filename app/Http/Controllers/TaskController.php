<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\Task\TaskService;

class TaskController extends Controller
{
    public function __construct
    (
        protected TaskService $taskService,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $res = $this->taskService->tasks();

            return response()->json($res, 200);
        }
        catch (\Exception $e){
            return response()->json([
                "data" => [],
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try {
            // set validated
            $validated = $request->validated();

            $res = $this->taskService
                ->setTitle($validated['title'])
                ->setDueDate($validated['due_date'])
                ->setDescription($validated['description'])
                ->create();

            return response()->json($res, 200);
        }
        catch (\Exception $e){
            return response()->json([
                "data" => [],
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $res = $this->taskService
                ->setId($id)
                ->task();

            return response()->json($res, 200);
        }
        catch (\Exception $e){
            return response()->json([
                "data" => [],
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        try {
            // set validated
            $validated = $request->validated();

            $res = $this->taskService
                ->setId($id)
                ->setTitle($validated['title'])
                ->setDueDate($validated['due_date'])
                ->setDescription($validated['description'])
                ->setIsCompleted($validated['is_completed'])
                ->update();

            return response()->json($res, 200);
        }
        catch (\Exception $e){
            return response()->json([
                "data" => [],
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $res = $this->taskService
                ->setId($id)
                ->delete();

            return response()->json($res, 200);
        }
        catch (\Exception $e){
            return response()->json([
                "data" => [],
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ], 400);
        }
    }
}
