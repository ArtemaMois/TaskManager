<?php 

namespace App\Http\Controllers\api\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Chat\GetPersonalUserChatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    public function personal(GetPersonalUserChatRequest $request)
    {
    }
}