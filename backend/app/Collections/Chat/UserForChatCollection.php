<?php 

namespace App\Collections\Chat;

use App\Http\Resources\api\User\UserForChatResource;

class UserForChatCollection
{
    public static function collection($collection)
    {
        return [
            'users' => UserForChatResource::collection($collection->items()),
            'nextPageRef' => $collection->nextPageUrl()
        ];
    }
}