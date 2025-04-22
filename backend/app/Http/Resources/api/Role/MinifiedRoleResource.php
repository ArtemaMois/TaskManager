<?php

namespace App\Http\Resources\api\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinifiedRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name
        ];
    }
}
