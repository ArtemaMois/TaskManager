<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Claim extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'category_id',
        'file_url',
        'claim_status_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function claimStatus(): BelongsTo
    {
        return $this->belongsTo(ClaimStatus::class);
    }

    public function getLocalCreatedAt()
    {
        return Carbon::make($this->updated_at)->setTimezone(Auth::user()->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function getLocalUpdatedAt()
    {
        return Carbon::make($this->updated_at)->setTimezone(Auth::user()->settings->timezone->code)->format('H:i d-m-Y');
    }
}
