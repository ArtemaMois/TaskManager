<?php

namespace App\Http\Resources\api\Timezone;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimezoneResource extends JsonResource
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
            'code' => $this->code,
            'value' => $this->value,
            'created_at' => $this->getLocalCreatedAt(),
            'updated_at' => $this->getLocalUpdatedAt()
        ];
    }
}
