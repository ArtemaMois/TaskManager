<?php

namespace App\Http\Resources\api\Claim;

use App\Http\Resources\api\User\MinifiedUserResource;
use App\Http\Resources\api\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new MinifiedUserResource($this->user),
            'file' => $this->file_url,
            'claim_status' => $this->claimStatus->title,
            'category' => $this->category->title,
            'description' => $this->description
        ];
    }
}
