<?php

namespace App\Services\Chat;

use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    public function getPersonalChat(int $currentUserId, int $foreignUserId): array
    {
        $existingChat = $this->existsChat($currentUserId, $foreignUserId);
        if (!is_null($existingChat)) {
            $existingChat->append(['isNew' => false]);
            return ['isNewChat' => false, 'chat' => $existingChat];
        } else {
            return $this->newChat($currentUserId, $foreignUserId);
        }
    }

    private function newChat(int $currentUserId, int $foreignUserId): array
    {
        $chat = Chat::query()->create([
            'title' => "chat-$currentUserId$foreignUserId",
            'first_member_id' => $currentUserId,
            'second_member_id' => $foreignUserId,
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2000-01-01 10:00:00'),
            'created_at' =>  Carbon::createFromFormat('Y-m-d H:i:s', '2000-01-01 10:00:00')
        ]);
        return ['isNewChat' => true, 'chat' => $chat];
    }

    public function existsChat(int $currentUserId, int $foreignUserId): Chat|null
    {
        return Chat::where([
            ['first_member_id', '=', $currentUserId],
            ['second_member_id', '=', $foreignUserId]
        ])->orWhere(function ($query) use ($currentUserId, $foreignUserId) {
            return $query->where([
                ['first_member_id', '=', $foreignUserId],
                ['second_member_id', '=', $currentUserId]
            ]);
        })->first();
    }

    public function getLastChats()
    {
        $currentUserId = Auth::user()->id;
        $chats = Chat::where('first_member_id', '=', $currentUserId)
            ->orWhere('second_member_id', '=', $currentUserId)
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
        // $result = $chats->filter(callback: function ($item) {
        //     if($item->messages->count() > 0)
        //     {
        //         return $item;
        //     }
        // });
        return $chats;
    }
}
