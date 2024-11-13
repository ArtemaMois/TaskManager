<?php

namespace App\Http\Controllers\api\Claim;

use App\Facades\Claim\ClaimFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Claim\StoreClaimRequest;
use App\Http\Requests\api\Claim\UpdateClaimRequest;
use App\Http\Resources\api\Claim\ClaimResource;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimsController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'claims' => ClaimResource::collection(Claim::all())]);
    }

    public function store(StoreClaimRequest $request)
    {
        $claim = ClaimFacade::storeClaim($request->validated(), $request->file("file"));
        return response()->json(['status' => 'success', 'claim' => new ClaimResource($claim)]);
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        $claim->update($request->validated());
        ClaimFacade::sendEmailResponseToUser($claim, $claim->user);
        return response()->json(['status' => 'success', 'claim' => new ClaimResource($claim)]);
    }
}
