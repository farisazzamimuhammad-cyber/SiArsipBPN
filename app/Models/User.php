<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

#[Fillable(['name', 'email', 'password', 'jabatan_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements LaratrustUser
{
    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function borrowings()
    {
    return $this->hasMany(Borrowing::class);
    }

    public function jabatan()
    {
    return $this->belongsTo(Jabatan::class);
    }

}