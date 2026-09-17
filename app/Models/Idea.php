<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $table = 'ideas';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'idea_text',
        'content',
        'cafe_name',
        'city',
        'vibe',
        'budget',
        'image',
        'image_path',
        'sparks',
        'sparks_count',
        'created_at',
    ];

    protected $appends = ['image_url', 'content', 'idea_text', 'sparks_count'];

    public function getContentAttribute()
    {
        return $this->attributes['content'] ?? $this->attributes['idea_text'] ?? '';
    }

    public function getIdeaTextAttribute()
    {
        return $this->attributes['idea_text'] ?? $this->attributes['content'] ?? '';
    }

    public function getSparksCountAttribute()
    {
        return (int)($this->attributes['sparks_count'] ?? $this->attributes['sparks'] ?? 0);
    }

    public function getSparksAttribute()
    {
        return (int)($this->attributes['sparks'] ?? $this->attributes['sparks_count'] ?? 0);
    }

    public function getImageUrlAttribute()
    {
        $img = $this->image ?? $this->image_path ?? null;
        if (empty($img)) {
            return null;
        }
        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
            return $img;
        }
        return asset($img);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
