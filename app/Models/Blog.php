<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    public $timestamps = false;

    protected $fillable = [
        'slug',
        'title',
        'category',
        'excerpt',
        'content',
        'image_icon',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
