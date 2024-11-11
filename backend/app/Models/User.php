<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{


    use HasFactory, Notifiable;

    protected $fillable = [
        'login',
        'email',
        'email_verified_at',
        'password',
        'photo_url',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function codes(): HasMany
    {
        return $this->hasMany(VerificationCode::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(Setting::class);
    }
    public function getLocalCreatedAt()
    {
        return Carbon::make($this->created_at)->setTimezone( $this->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function getLocalUpdatedAt()
    {
        return Carbon::make($this->updated_at)->setTimezone( $this->settings->timezone->code)->format('H:i d-m-Y');
    }
}
