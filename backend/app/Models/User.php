<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{


    use HasApiTokens, HasFactory, Notifiable;

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

    public function resetCodes(): HasMany
    {
        return $this->hasMany(ResetPasswordCode::class);
    } 

    public function settings(): HasOne
    {
        return $this->hasOne(Setting::class);
    }

    public function mentor(): HasOne
    {
        return $this->hasOne(Mentor::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_user');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function getLocalCreatedAt()
    {
        return Carbon::make($this->created_at)->setTimezone( $this->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function getLocalUpdatedAt()
    {
        return Carbon::make($this->updated_at)->setTimezone( $this->settings->timezone->code)->format('H:i d-m-Y');
    }

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

    public function performingTasks(): HasMany
    {
        return $this->hasMany(PerformingTask::class);
    }

    public function performingCheckpoints(): HasMany
    {
        return $this->hasMany(PerformedCheckpoint::class);
    }

    public function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                if(!is_null($value))
                {
                    // return  env("APP_URL") . $value;
                    return $value;
                }
                return null;
            } 
        );
    }

    public function myChats()
    {
    }

    public function taskGrades()
    {
        return $this->hasMany(TaskGrade::class);
    }

}
