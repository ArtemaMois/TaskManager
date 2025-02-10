<?php 

namespace App\Services\Chat;

use App\Models\Chat;
use App\Models\ChatUser;
use Illuminate\Database\Query\Expression;

class ChatService
{
    public function getPersonalChat(int $currentUserId, int $foreignUserId)
    {
        $existingChat = $this->existsChat($currentUserId, $foreignUserId);
        if(!is_null($existingChat))
        {
            return $existingChat->chat;
        } else{
            return $this->newChat($currentUserId, $foreignUserId);
        }
    }

    private function newChat(int $currentUserId, int $foreignUserId): Chat
    {
        $chat = Chat::query()->create([
            'title' => "chat-$currentUserId$foreignUserId"
        ]);
        $this->newChatUser($chat->id, $currentUserId, $foreignUserId);
        return $chat;
    }

    public function newChatUser(int $chatId, int $currentUserId, int $foreignUserId): ChatUser
    {
        return ChatUser::query()->create(
            [
                'chat_id' => $chatId,
                'first_member_id' => $currentUserId,
                'second_member_id' => $foreignUserId
            ]
        );
    }

    public function existsChat(int $currentUserId, int $foreignUserId): ChatUser|null
    {
        return ChatUser::where([
            ['first_member_id', '=', $currentUserId],
            ['second_member_id', '=', $foreignUserId]
        ])->orWhere(function ($query) use ($currentUserId, $foreignUserId) {
            return $query->where([
                ['first_member_id', '=', $foreignUserId],
                ['second_member_id', '=', $currentUserId]
            ]);
        })->first();
    }
}