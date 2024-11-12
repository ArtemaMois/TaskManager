<?php 

namespace App\Services\ClaimStatus;

use App\Models\ClaimStatus;

class ClaimStatusService 
{
    public function getHandleStatus(): ClaimStatus|null
    {
        $status = ClaimStatus::query()->where('code', 'handling')->first();
        return $status;
    }

    public function getCompleteStatus(): ClaimStatus|null
    {
        $status = ClaimStatus::query()->where('code', 'complete')->first();
        return $status;
    }

    public function getRejectStatus(): ClaimStatus|null
    {
        $status = ClaimStatus::query()->where('code', 'reject')->first();
        return $status;
    }
}