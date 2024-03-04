<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id', 'mbid',
    ];

    public function user()
    {

        return $this->hasMany('App\Models\User', 'user_id');

    }
}