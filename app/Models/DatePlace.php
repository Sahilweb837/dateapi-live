<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatePlace extends Model
{
    protected $table = 'date_places';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'city',
        'description',
        'address',
        'lat',
        'lng',
        'rating',
        'cup_offer',
        'image_url',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'rating' => 'float',
    ];
}
