<?php 

namespace App\Http\Controllers\api\WS;

use App\Extensions\Centrifugo\Facades\CentrifugoClientFacade;
use App\Extensions\Centrifugo\Facades\CentrifugoFacade;
use App\Extensions\Centrifugo\Services\CentrifugoService;
use Illuminate\Http\Request;

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

    public function publish(Request $request)
    {
        $message = $request->get('message');
        $channel = $request->get('channel');
        CentrifugoClientFacade::publish($channel, [$message]);
        return response()->json(['status' => 'success']);
    }
}