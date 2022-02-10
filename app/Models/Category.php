<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];
    //
    /**
     * Get the comments for this category.
     */
    public function weapons()
    {
        return $this->hasMany(Weapon::class);
    }
}
