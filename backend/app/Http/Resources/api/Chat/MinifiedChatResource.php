<?php

namespace App\Http\Resources\api\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinifiedChatResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title
        ];
    }
}
