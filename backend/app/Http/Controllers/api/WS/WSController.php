<?php 

namespace App\Http\Controllers\api\WS;

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
}