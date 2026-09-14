<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'member_code',
        'full_name',
        'email',
        'password',
        'google_id',
        'dob',
        'gender',
        'preference',
        'interested_in',
        'bio',
        'avatar',
        'lat',
        'lng',
        'country',
        'interests',
        'astrology',
        'mbti',
        'coffee_style',
        'instagram',
        'snapchat',
        'premium_status',
        'status',
        'coins',
        'xp',
        'is_verified',
        'is_admin',
        'is_boosted',
        'boosted_until',
        'last_active',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'security_pin',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_admin' => 'boolean',
        'coins' => 'integer',
        'xp' => 'integer',
        'lat' => 'float',
        'lng' => 'float',
        'boosted_until' => 'datetime',
    ];

    public function getFormattedMemberIdAttribute()
    {
        if (!empty($this->member_code)) {
            return $this->member_code;
        }
        return 'CD-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function getAgeAttribute()
    {
        if (!empty($this->dob) && $this->dob !== '0000-00-00') {
            try {
                return \Carbon\Carbon::parse($this->dob)->age;
            } catch (\Exception $e) {
                return 24;
            }
        }
        return 24;
    }

    public function getAvatarUrlAttribute()
    {
        if (empty($this->avatar) || str_starts_with($this->avatar, 'default')) {
            return asset('assets/images/default_avatar.png');
        }
        if (str_starts_with($this->avatar, 'http')) {
            return $this->avatar;
        }
        return asset($this->avatar);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
