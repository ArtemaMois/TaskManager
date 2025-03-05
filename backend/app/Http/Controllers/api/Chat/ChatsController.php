<?php 

namespace App\Http\Controllers\api\Chat;

use App\Facades\Chat\ChatFacade;
use App\Facades\Message\MessageFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Chat\GetPersonalUserChatRequest;
use App\Http\Resources\api\Chat\MinifiedChatResource;
use App\Http\Resources\api\Message\MinifiedMessageResource;
use App\Models\Chat;
use App\Models\ChatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{

    public function personal(GetPersonalUserChatRequest $request)
    {
        $chatInfo = ChatFacade::getPersonalChat(Auth::user()->id, $request->get('user_id')); 
        $messages = MessageFacade::getOrderedChatMessages($chatInfo->id);
        return response()->json(['chat' => new MinifiedChatResource($chatInfo), 'messages' => MinifiedMessageResource::collection($messages)]);
    }


}