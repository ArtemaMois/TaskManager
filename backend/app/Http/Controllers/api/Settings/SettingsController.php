<?php

namespace App\Http\Controllers\api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Settings\UpdateSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Auth::user()->settings;
        return response()->json(['status' => 'success', 'data' => ['settings' => $settings]]);
    }
    public function update(UpdateSettingsRequest $request)
    {
        Auth::user()->settings->update($request->validated());
        $settings = Auth::user()->settings;
        return response()->json(['status' => 'success', 'data' => ['settings' => $settings]]);
    }
}
