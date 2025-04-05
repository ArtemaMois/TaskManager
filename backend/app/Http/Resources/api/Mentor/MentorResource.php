<?php

namespace App\Http\Resources\api\Mentor;

use App\Http\Resources\api\Category\CategoryResource;
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
            'login' => $this->login,
            'user' => $this->user_id,
            'categories' => CategoryResource::collection($this->categories),
            'about_me' => $this->about_me,
            'created_at' => $this->created_at
        ];
    }
}
