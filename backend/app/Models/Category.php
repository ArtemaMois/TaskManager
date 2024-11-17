<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{

    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'title',
        'slug'
    ];

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn($item) => ucfirst($item)
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLocalCreatedAt()
    {
        return Carbon::make($this->created_at)->setTimezone( Auth::user()->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function getLocalUpdatedAt()
    {
        return Carbon::make($this->updated_at)->setTimezone( Auth::user()->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function mantors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class);
    }
    
}
