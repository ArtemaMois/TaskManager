<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformedCheckpoint extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'checkpoint_id',
        'is_completed'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class);
    }
}
