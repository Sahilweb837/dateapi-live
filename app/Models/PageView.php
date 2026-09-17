<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $table = 'page_views';

    protected $fillable = [
        'ip_address',
        'url',
        'route_name',
        'method',
        'user_agent',
        'referer',
        'user_id',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
