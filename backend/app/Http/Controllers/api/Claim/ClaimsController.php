<?php

namespace App\Http\Controllers\api\Claim;

use App\Events\api\Claim\CompleteClaimEvent;
use App\Facades\Claim\ClaimFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Claim\StoreClaimRequest;
use App\Http\Requests\api\Claim\UpdateClaimRequest;
use App\Http\Resources\api\Claim\ClaimResource;
use App\Models\Claim;
use App\Models\ClaimStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClaimsController extends Controller
{
    public function index()
    {
        $claims = Claim::query()->where('claim_status_id', ClaimStatus::query()->where('code', 'handling')->first()->id)->get();
        return response()->json(['status' => 'success', 'claims' => ClaimResource::collection($claims)]);
    }

    public function store(StoreClaimRequest $request)
    {
        $claim = ClaimFacade::storeClaim($request->validated(), $request->file("file"));
        return response()->json(['status' => 'success', 'claim' => new ClaimResource($claim)]);
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        DB::transaction(function () use ($request, $claim) {
            $claim->update($request->validated());
            event(new CompleteClaimEvent($claim, $claim->user, $claim->category));
        });
        return response()->json(['status' => 'success', 'claim' => new ClaimResource($claim)]);
    }
}
