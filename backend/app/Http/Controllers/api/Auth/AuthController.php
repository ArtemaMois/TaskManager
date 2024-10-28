<?php

namespace App\Http\Controllers\api\Auth;

use App\Facades\Auth\AuthFacade;
use App\Facades\Email\EmailFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Auth\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = AuthFacade::registerUser($request->validated());
        return response()->json(['status' => 'success', 'data' => ['user' => $user]], 201);
    }

    public function login()
    {

    }
}
