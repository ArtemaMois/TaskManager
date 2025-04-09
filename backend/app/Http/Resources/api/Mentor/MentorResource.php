<?php

namespace App\Http\Resources\api\Mentor;

use App\Http\Resources\api\Category\CategoryResource;
use App\Http\Resources\api\Category\MentorCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MentorResource extends JsonResource
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
            'login' => $this->user->login,
            'image' => $this->user->photo_url,
            'categories' => MentorCategoryResource::collection($this->categories),
            'tasks' => $this->tasks->count(),
            'grade' => $this->grades->avg('stars') ?? 0
        ];
    }
}
