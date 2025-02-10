<?php

namespace App\Http\Controllers\api\User;

use App\Collections\Chat\UserForChatCollection;
use App\Facades\User\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Password\ResetPasswordRequest;
use App\Http\Requests\api\Password\UpdatePasswordRequest;
use App\Http\Requests\api\User\UpdateUserRequest;
use App\Http\Resources\api\User\UserForChatResource;
use App\Http\Resources\api\User\UserResource;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query()->when($request->get('search'), function ($query) use ($request) {
            return $query->where('login', 'ILIKE', '%' . $request->get('search') . '%'); 
        })->paginate(10);
        return response()->json(['status' => 'success', 'users' => $users]);
    }

    public function me()
    {
        return response()->json(['status' => 'success', 'user' => new UserResource(Auth::user())]);
    }

    //TODO: сделать s3
    public function update(UpdateUserRequest $request)
    {
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

    public function getCookie()
    {
        $xsrf = Cookie::get('XSRF-TOKEN');
        return response()->json(['status' => 'success', 'token' => $xsrf]);
    }

    public function userForChats(Request $request)
    {
        $users = User::query()->when($request->get('search'), function ($query) use ($request) {
            return $query->where('login', 'ILIKE', '%' . $request->get('search') . '%'); 
        })
        ->where('id', '!=', Auth::user()->id)
        ->paginate(10);
        return response()->json(['status' => 'success', 'data' => UserForChatCollection::collection($users)]);
    }

}
