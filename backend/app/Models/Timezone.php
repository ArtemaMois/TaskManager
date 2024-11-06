<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Timezone extends Model
{

    use HasFactory;
    protected $fillable = [
        'code',
        'value'
    ];

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
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
