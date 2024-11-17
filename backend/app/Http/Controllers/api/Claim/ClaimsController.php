<?php

namespace App\Http\Controllers\api\Claim;

use App\Events\api\Claim\CompleteClaimEvent;
use App\Facades\Claim\ClaimFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Claim\StoreClaimRequest;
use App\Http\Requests\api\Claim\UpdateClaimRequest;
use App\Http\Resources\api\Claim\ClaimResource;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        event(new CompleteClaimEvent($claim, $claim->user, $claim->category));
        return response()->json(['status' => 'success', 'claim' => new ClaimResource($claim)]);
    }
}
