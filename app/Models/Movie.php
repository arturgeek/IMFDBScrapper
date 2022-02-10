<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['name', 'slug'];
    /**
     * Get the weapons for this movie.
     */
    public function weapons()
    {
        return $this->hasMany(Weapon::class);
    }
}
