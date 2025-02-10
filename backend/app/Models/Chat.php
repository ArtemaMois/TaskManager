<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'title'
    ];

    // public function first_member()
    // {
    //     return $this->belongsToMany(User::class, 'chat_user','first_member_id', 'id')->withPivotValue(['id', 'login', 'email']);
    // }

    // public function second_member()
    // {
    //     return $this->belongsTo(User::class, 'second_member_id', 'id');
    // }

    public function first_member_id()
    {
        return $this->belongsToMany(User::class, 'chat_user', 'id','first_member_id');
    }

    public function second_member_id()
    {
        return $this->belongsToMany(User::class, 'chat_user', 'id','second_member_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
