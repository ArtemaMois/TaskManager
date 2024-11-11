<?php

namespace App\Http\Controllers\api\Timezone;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\Timezone\TimezoneResource;
use App\Models\Timezone;
use Illuminate\Http\Request;

class TimezoneController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'timezones' => TimezoneResource::collection(Timezone::all())]);
    }

}
