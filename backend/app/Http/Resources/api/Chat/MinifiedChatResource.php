<?php

namespace App\Http\Resources\api\Chat;

use App\Http\Resources\api\Message\LastMessageForChatResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MinifiedChatResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        if($this->first_member_id == Auth::user()->id)
        {
            $user = $this->second_member()->first(); 
            $login = $user->login;
            $userId = $user->id;
            $image = $user->photo_url;
        } else {
            $user = $this->first_member()->first(); 
            $login = $user->login;
            $userId = $user->id;
            $image = $user->photo_url;
        }
        
        return [
            'id' => $this->id,
            'title' => $this->title,
            'login' => $login,
            'userId' => $userId,
            'image' => $image,
            'message' => new LastMessageForChatResource($this->messages()->orderBy('created_at', 'desc')->first()),
            'updatedAt' => Carbon::make($this->updated_at)->format('H:i')
        ];
    }
}
