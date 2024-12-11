<?php

namespace App\Http\Resources\api\Task;

use App\Http\Resources\api\Categories\MinifiedCategoryResource;
use App\Http\Resources\api\Checkpoint\MinifiedCheckpointResource;
use App\Http\Resources\api\Mentors\MinifiedMentorResource;
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'iframe' => $this->iframe,
            'created_at' => $this->created_at,
            'checkpoints' => MinifiedCheckpointResource::collection($this->checkpoints),
            'category' => new MinifiedCategoryResource($this->category),
            'mentor' => new MinifiedMentorResource($this->mentor),
        ];
    }
}
