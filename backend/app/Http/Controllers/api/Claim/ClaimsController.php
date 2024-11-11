<?php

namespace App\Http\Controllers\api\Claim;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\Claim\ClaimResource;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimsController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'claims' => ClaimResource::collection(Claim::all())]);
    }

    public function store()
    {

    }

    public function update()
    {
        
    }
}
