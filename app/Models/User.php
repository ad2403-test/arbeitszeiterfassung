<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PragmaRX\Google2FA\Google2FA;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'password',
        'rfid_uid',
         'two_factor_secret',
        'two_factor_enabled',
        'two_factor_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
         'google2fa_secret',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array  {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isUser(): bool {
        return $this->role === 'user';
    }

    public function workLogs(){
        return $this->hasMany(WorkLog::class);
    }

    public function generate2FASecret()
    {
        $this->google2fa_secret = app(Google2FA::class)->generateSecretKey();
        $this->save();
    }

    // app/Models/User.php
    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }

}
