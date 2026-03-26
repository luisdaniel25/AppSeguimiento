<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }



    public function adminlte_image()
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('img/user-default.png');
    }

    public function adminlte_desc(): string
    {

        return $this->getRoleNames()->first() ?? 'Usuario';
    }

    public function adminlte_profile_url(): string
    {
        return route('admin.profile');
    }
}
