<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'categoryName'
    ];

    public function posts() {
        return $this->hasMany('App\Model\Post');
    }

    public function user() {
        return $this->hasMany('App\User');
    }
}
