<?php

namespace App\Http\Controllers\api\Auth;

use App\Facades\Auth\AuthFacade;
use App\Facades\Email\EmailFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Auth\LoginRequest;
use App\Http\Requests\api\Auth\RegisterRequest;
use App\Http\Resources\api\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsUnprocessable;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = AuthFacade::registerUser($request->validated());
        return response()->json(['status' => 'success', 'data' => ['user' => new UserResource($user)]], 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed', 'errors' => 'Неверные данные для входа']);
    }
    public function time()
    {
        $user = User::query()->first();
        return response()->json(['user' => new UserResource($user)]);
    }
}
