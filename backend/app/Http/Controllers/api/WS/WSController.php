<?php 

namespace App\Http\Controllers\api\WS;

use App\Extensions\Centrifugo\Facades\CentrifugoClientFacade;
use App\Extensions\Centrifugo\Facades\CentrifugoFacade;
use App\Extensions\Centrifugo\Services\CentrifugoService;
use App\Http\Resources\api\Message\MinifiedMessageResource;
use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WSController
{
    public function connectionToken(Request $request)
    {
        $token = CentrifugoFacade::getClientConnectionToken();
        return response()->json(['token' => $token]);
    }

    public function channels()
    {
        $channels = CentrifugoClientFacade::channels();
        return response()->json(['channels' => $channels]);
    }

    public function publish(Chat $chat, Request $request)
    {
        $messageBody = $request->get('message');
        $channel = $chat->title;
        $message = Message::query()->create([
            'body' => $messageBody,
            'user_id' => Auth::user()->id,
            'chat_id' => $chat->id
        ]);
        $chat->update([
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        CentrifugoClientFacade::publish($channel, ['message' => new MinifiedMessageResource($message)]);
        return response()->json(['status' => 'success', ]);
    }
}