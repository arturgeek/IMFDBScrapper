<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaponsInMovies extends Model
{
    protected $fillable = ['movie_id', 'weapon_id'];
}
