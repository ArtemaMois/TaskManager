<?php

namespace App\Http\Controllers\api\Auth;

use App\Facades\Auth\AuthFacade;
use App\Facades\Email\EmailFacade;
use App\Facades\Password\ResetPasswordFacade;
use App\Facades\User\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Auth\LoginRequest;
use App\Http\Requests\api\Auth\RegisterRequest;
use App\Http\Requests\api\Password\CheckResetCodeRequest;
use App\Http\Requests\api\Password\ResetPasswordRequest;
use App\Http\Requests\api\Password\UpdatePasswordRequest;
use App\Http\Resources\api\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsUnprocessable;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = AuthFacade::registerUser($request->validated());
        $credentials = ['login' => $user->login, 'password' => $request->input('password')];
        $response = [
            'status' => 'success',
            'role' => $user->role->code,
        ];
        if(Auth::attempt($credentials))
        {
            $token = AuthFacade::getApiToken(Auth::user());
            $response['api_token'] = $token; 
        }
        return response()->json($response, 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $token = AuthFacade::getApiToken(Auth::user());
            return response()->json(['status' => 'success', 'token' => $token]);
        }
        return response()->json(['status' => 'failed', 'errors' => 'Неверные данные для входа'], 400);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = UserFacade::getUserByEmail($request->input('email'));
        AuthFacade::resetPassword($user);
        return response()->json(['status' => 'success']);
    }

    public function checkResetCode(CheckResetCodeRequest $request)
    {
        $code = ResetPasswordFacade::getLastUserResetCode($request->input('email'));
        $errors = ResetPasswordFacade::checkResetCode($code, $request->input('code'));
        return !empty($errors) ?
            response()->json(['status' => 'failed', 'errors' => $errors], 400) :
            response()->json(['status' => 'success'], 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        Auth::logout();
        return response()->json(['status' => 'success']);
    }


}
