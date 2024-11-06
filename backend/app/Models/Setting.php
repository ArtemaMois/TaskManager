<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }
}
