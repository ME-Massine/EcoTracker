<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{
    protected $fillable = ['title', 'description', 'points']; // les champs qui peuvent etre remplis

    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_challenges')->withPivot('status');
        // relation entre les challenges et les utilisateurs
    }
}
