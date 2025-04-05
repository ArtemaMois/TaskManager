<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{

    protected $fillable = [
        'title',
        'first_member_id',
        'second_member_id',
        'updated_at',
        'created_at'
    ];


    public function first_member()
    {
        return $this->belongsTo(User::class,  'first_member_id','id');
    }

    public function second_member()
    {
        return $this->belongsTo(User::class, 'second_member_id','id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function foreignUser()
    {
        if($this->first_member_id == Auth::user()->id)
        {
            return $this->second_member()->first();
        } else {
            return $this->first_member()->first();
        }
    }
}
