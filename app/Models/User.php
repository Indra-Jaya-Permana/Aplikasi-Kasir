<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'profile_photo', 'last_activity', 'is_active',
    ];

    protected $dates = ['last_activity'];

    public function checkActivityStatus()
    {
        if ($this->role === 'petugas' && $this->last_activity) {
            $inactiveThreshold = Carbon::now()->subDays(7);
            $this->is_active = $this->last_activity >= $inactiveThreshold;
            $this->save();
        }
    }

    protected $attributes = [
        'is_active' => false, // Akun baru dianggap tidak aktif
        'last_activity' => null, // Belum ada aktivitas
    ];
    
}

