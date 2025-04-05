<?php 

namespace App\Collections\Chat;

use App\Http\Resources\api\Chat\MinifiedChatResource;
use App\Http\Resources\api\User\UserForChatResource;

class InitialChatsCollection
{
    public static function collection($collection)
    {
        return [
            'chats' => MinifiedChatResource::collection($collection->items()),
            'nextPageRef' => $collection->nextPageUrl()
        ];
    }
}