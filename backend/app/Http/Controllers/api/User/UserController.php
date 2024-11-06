<?php

namespace App\Http\Controllers\api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\User\UserResource;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(['status' => 'success', 'users' => UserResource::collection($users)]);
    }
    public function update()
    {
        
    }

}
