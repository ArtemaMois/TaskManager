<?php

namespace App\Http\Resources\api\User;

use App\Http\Resources\api\Role\MinifiedRoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserForAdminResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'image' => $this->photo_url,
            'role' => new MinifiedRoleResource($this->role)
        ];
    }
}
