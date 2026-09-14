<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $table = 'ideas';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'content',
        'cafe_name',
        'city',
        'image',
        'sparks_count',
        'created_at',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }
        return asset($this->image);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
