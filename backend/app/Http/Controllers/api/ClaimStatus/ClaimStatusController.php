<?php

namespace App\Http\Controllers\api\ClaimStatus;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\ClaimStatus\StoreClaimStatusRequest;
use App\Http\Resources\api\ClaimStatus\ClaimStatusResource;
use App\Models\ClaimStatus;
use Illuminate\Http\Request;

class ClaimStatusController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'claim_statuses' => ClaimStatusResource::collection(ClaimStatus::all())]);
    }

    public function store(StoreClaimStatusRequest $request)
    {
        $status = ClaimStatus::query()->create($request->validated());
        return response()->json(['status' => 'success', 'claim_status' => new ClaimStatusResource($status)]);
    }

    public function delete(ClaimStatus $status)
    {
        $status->delete();
        return response()->noContent();
    }
}
