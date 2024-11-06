<?php

namespace App\Http\Controllers\api\User;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update()
    {
        
    }

    public function changeTimezone(Request $request)
    {
        Setting::query()->first()->update(['timezone_id' => $request->input('timezone_id')]);
    }
}
