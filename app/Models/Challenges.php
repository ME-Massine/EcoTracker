<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{

    protected $fillable = ['title', 'description', 'points'];

    public function Users()
    {
        return $this->belongsToMany(Users::class, 'user__challenges')->withPivot('status');
    }
}
