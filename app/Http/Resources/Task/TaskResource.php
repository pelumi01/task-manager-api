<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "due_date" => $this->due_date,
            "is_completed" => (bool) $this->is_completed,
            "description" => $this->description,
            "created_at" => $this->created_at,
        ];
    }
}
