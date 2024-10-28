<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
