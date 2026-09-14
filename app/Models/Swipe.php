<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Swipe extends Model
{
    protected $table = 'swipes';
    public $timestamps = false;

    protected $fillable = [
        'swiper_id',
        'swipee_id',
        'type',
        'created_at',
    ];

    public function swiper()
    {
        return $this->belongsTo(User::class, 'swiper_id');
    }

    public function swipee()
    {
        return $this->belongsTo(User::class, 'swipee_id');
    }
}
