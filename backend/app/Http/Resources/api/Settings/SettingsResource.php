<?php

namespace App\Http\Resources\api\Settings;

use App\Http\Resources\api\Timezone\TimezoneResource;
use App\Http\Resources\api\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'timezone' => new TimezoneResource($this->timezone),
            'task_notifications' => $this->task_notifications,
            'created_at' => $this->getLocalCreatedAt(),
            'updated_at' => $this->getLocalUpdatedAt()
        ];
        if (Auth::user()->role->code != 'user') {
            $result['follow_notifications'] = $this->follow_notifications;
        };
        return $result;
    }
}
