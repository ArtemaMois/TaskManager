<?php

namespace App\Http\Controllers\api\User;

use App\Facades\User\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Password\ResetPasswordRequest;
use App\Http\Requests\api\Password\UpdatePasswordRequest;
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
        return response()->json(['file' => $request->files]);
        $photoPath = $request->hasFile('photo') ? UserFacade::storeFile($request->file('photo')) : null;
        $updateData = UserFacade::getUpdatedData($request->validated(), $request->file('photo'));
        Auth::user()->update($updateData);
        return response()->json(['status' => 'success', 'user' => new UserResource(Auth::user())]);
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        $user = UserFacade::getUserByEmail($request->input('email'));
        $user = UserFacade::updatePassword($user, $request->input('password'));
        return response()->json(['status' => 'success', 'user' => $user]);
    }

}
