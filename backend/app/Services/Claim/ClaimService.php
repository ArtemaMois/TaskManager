<?php

namespace App\Services\Claim;

use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Facades\Category\CategoryFacade;
use App\Facades\ClaimStatus\ClaimStatusFacade;
use App\Jobs\api\Claim\SendClaimResponseJob;
use App\Models\Claim;
use App\Models\User;
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
        $fullPath = Storage::disk('public')->path($uploadedFile);
        $resultPath = str_replace('//', '/', '/storage/' . explode('uploads', $fullPath)[1]);
        return $resultPath;
    }

    private function setDefaultClaimStatus()
    {
        return ClaimStatusFacade::getHandleStatus();
    }

    public function sendEmailResponseToUser(Claim $claim, User $user)
    {
        $message = RabbitMessage::makeMessage(SendClaimResponseJob::class, ['user' => $user, 'claim' => $claim]);
        RabbitMQ::publish($message, 'laravel', 'verification');
    }

}
