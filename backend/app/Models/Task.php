<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'mentor_id',
        'category_id',
        'iframe'
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function checkpoints(): HasMany
    {
        return $this->hasMany(Checkpoint::class);
    }

    public function performingTask()
    {
        return $this->hasMany(PerformingTask::class);
    }
    
    public function performedCheckpoint()
    {
        return $this->hasMany(PerformedCheckpoint::class);
    }

    public function taskGrades()
    {
        return $this->hasMany(TaskGrade::class);
    }
}
