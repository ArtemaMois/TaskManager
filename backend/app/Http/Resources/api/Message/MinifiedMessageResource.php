<?php

namespace App\Http\Resources\api\Message;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MinifiedMessageResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'chat' => $this->chat->id,
            'isMy' => $this->user->id == Auth::user()->id,
            'user' => Auth::user()->id,
            'updatedAt' => Carbon::make($this->updated_at)->format('H:i')
        ];
    }
}
