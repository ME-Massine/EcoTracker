<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Challenges extends Model
{
    protected $fillable = [
        'user_id',
        'challenge_id',
        'status'
    ];
}
