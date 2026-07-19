<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

#[Fillable(['email', 'password', 'display_name', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUlids;

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
}
