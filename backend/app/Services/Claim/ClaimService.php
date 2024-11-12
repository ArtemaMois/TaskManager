<?php 

namespace App\Services\Claim;

use App\Facades\Category\CategoryFacade;
use App\Facades\ClaimStatus\ClaimStatusFacade;
use App\Models\Claim;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClaimService
{
    public function storeClaim(array $data, UploadedFile|null $file): Claim
    {
        $data['user_id'] = Auth::user()->id;
        $data['claim_status_id']  = $this->setDefaultClaimStatus()->id;
        $data['file_url'] = is_null($file) ? null : $this->saveClaimFile($file);
        $data['category_id'] = CategoryFacade::getCategoryBySlug($data['category'])->id;
        unset($data['category'], $data['file']);
        $claim = Claim::query()->create($data);
        return $claim;
    }

    private function saveClaimFile(UploadedFile $file)
    {
        $uploadedFile = Storage::disk('public')->putFile('/uploads/claims/', $file);
        $fullPath= Storage::disk('public')->path($uploadedFile);
        $resultPath = str_replace('//', '/', '/storage/' . explode('uploads', $fullPath)[1]);
        return $resultPath;
    }

    private function setDefaultClaimStatus()
    {
        return ClaimStatusFacade::getHandleStatus();
    }
    
}