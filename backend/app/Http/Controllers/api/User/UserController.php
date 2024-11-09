<?php

namespace App\Http\Controllers\api\User;

use App\Facades\User\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\User\UpdateUserRequest;
use App\Http\Resources\api\User\UserResource;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(['status' => 'success', 'users' => UserResource::collection($users)]);
    }

    //TODO: сделать s3
    public function update(UpdateUserRequest $request)
    {
        $request->hasFile('photo') ? UserFacade::storeFile($request->file('photo')) : null;
        Auth::user()->update([
            'login' => $request->input('login')
        ]);
    }

}
