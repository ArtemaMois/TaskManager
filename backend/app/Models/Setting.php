<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Setting extends Model
{

    protected $fillable = [
        'user_id',
        'language_id',
        'timezone_id',
        'folow_notifications',
        'task_notifications'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }

    public function getLocalCreatedAt()
    {
        return Carbon::make($this->created_at)->setTimezone( Auth::user()->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function getLocalUpdatedAt()
    {
        return Carbon::make($this->created_at)->setTimezone( Auth::user()->settings->timezone->code)->format('H:i d-m-Y');
    }
}
