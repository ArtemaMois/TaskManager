<?php 

namespace App\Services\Message;

use App\Http\Resources\api\Message\MinifiedMessageResource;
use App\Models\Message;

class MessageService
{
    public function getOrderedChatMessages(int $chatId)
    {
        $messages = Message::where('chat_id', '=', $chatId)->get();
        return $messages;
    }
}