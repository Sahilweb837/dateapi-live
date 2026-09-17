<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'body',
        'attachment',
        'image_path',
        'is_read',
        'is_call_request',
        'call_status',
        'created_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    protected $appends = ['attachment_url'];

    public function getMessageAttribute($value)
    {
        return $value ?? ($this->attributes['body'] ?? '');
    }

    public function getAttachmentAttribute($value)
    {
        return $value ?? ($this->attributes['image_path'] ?? null);
    }

    public function getAttachmentUrlAttribute()
    {
        $path = $this->attachment ?: ($this->attributes['image_path'] ?? null);
        if (empty($path)) {
            return null;
        }
        return asset($path);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
