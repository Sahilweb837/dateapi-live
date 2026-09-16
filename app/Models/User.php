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

    public function getRememberTokenName()
    {
        return '';
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // No-op: prevents SQL error since users table does not have remember_token column
    }

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
        // If user has a real avatar (uploaded or Google URL), use it
        if (!empty($this->avatar) && !str_starts_with($this->avatar, 'default')) {
            if (str_starts_with($this->avatar, 'http')) {
                return $this->avatar;
            }
            return asset($this->avatar);
        }

        // Curated real portrait photos from Unsplash (free, no auth needed)
        $femalePhotos = [
            'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1546961342-ea5f62d95a23?w=400&q=80&fit=crop&crop=face',
        ];

        $malePhotos = [
            'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face',
            'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&q=80&fit=crop&crop=face',
        ];

        $gender = $this->gender ?? 'female';
        $pool = in_array($gender, ['male']) ? $malePhotos : $femalePhotos;
        $idx = ($this->id ?? 0) % count($pool);

        return $pool[$idx];
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
