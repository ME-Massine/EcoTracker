<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';


    protected $fillable = ['name', 'email', 'password']; // les champs qui peuvent etre remplis

    public function challenges()
    {
        // relation entre les utilisateurs et les challenges
        return $this->belongsToMany(Challenges::class, 'user_challenges')->withPivot('status');
    }
}
