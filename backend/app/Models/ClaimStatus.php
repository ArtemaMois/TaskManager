<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'code'
    ];

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

}
