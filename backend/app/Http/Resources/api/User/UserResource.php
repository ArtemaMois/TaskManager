<?php

namespace App\Http\Resources\api\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'email' => $this->email,
            'photo' => $this->photo_url,
            'role' => $this->role->code,
            'created_at' => $this->getLocalCreatedAt(),
            'updated_at' => $this->getLocalUpdatedAt(),
        ];
    }
}
