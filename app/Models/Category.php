<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
