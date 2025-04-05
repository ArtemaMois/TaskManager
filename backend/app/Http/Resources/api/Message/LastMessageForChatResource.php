<?php

namespace App\Http\Resources\api\Message;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LastMessageForChatResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'updatedAt' => Carbon::make($this->updated_at)->format('i:H')
        ];
    }
}
