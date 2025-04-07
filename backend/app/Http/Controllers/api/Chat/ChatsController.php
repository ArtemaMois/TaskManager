<?php 

namespace App\Http\Controllers\api\Chat;

use App\Collections\Chat\InitialChatsCollection;
use App\Facades\Chat\ChatFacade;
use App\Facades\Message\MessageFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Chat\GetPersonalUserChatRequest;
use App\Http\Resources\api\Chat\MinifiedChatResource;
use App\Http\Resources\api\Message\MinifiedMessageResource;
use App\Http\Resources\api\User\UserForChatResource;
use App\Models\Chat;
use App\Models\ChatUser;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{

    public function myChats(Request $request)
    {
        $chats = ChatFacade::getLastChats();
        return response()->json(['status' => 'success', 'data' => ['chats' => MinifiedChatResource::collection($chats), 'nextPageRef' => null]]);
    }
    
    public function personal(GetPersonalUserChatRequest $request)
    {
        $chatInfo = ChatFacade::getPersonalChat(Auth::user()->id, $request->get('user_id')); 
        $messages = MessageFacade::getOrderedChatMessages($chatInfo['chat']->id);
        return response()->json(['chat' => new MinifiedChatResource($chatInfo['chat']),
        'isNewChat' => $chatInfo['isNewChat'], 
        'messages' => MinifiedMessageResource::collection($messages),
        'user' => new UserForChatResource($chatInfo['chat']->foreignUser())]);
    }


}