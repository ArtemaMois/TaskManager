<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChatUser extends Pivot
{
    protected $table = 'chat_user';
    protected $fillable = [
        'first_member_id',
        'second_member_id',
        'chat_id'
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function first_member_id()
    {
        return $this->belongsToMany(User::class, 'chat_user', 'id','first_member_id');
    }

    public function second_member_id()
    {
        return $this->belongsToMany(User::class, 'chat_user', 'id','second_member_id');
    }

    public function getPersonalChat(int $currentUserId, int $foreignUserId)
    {
        return $this->where([
            ['first_member_id', '=', $currentUserId],
            ['second_member_id', '=', $foreignUserId]
        ])->orWhere([
            ['first_member_id', '=', $foreignUserId],
            ['second_member_id', '=', $currentUserId]
        ])->get();
    }
}
