<?php

declare(strict_types=1);

namespace Domains\Shared\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Domains\User\Models\Borrow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo {
        return $this->belongsTo(
            related: Role::class,
            foreignKey: 'role_id'
        );
    }

    public function bookBorrows(): HasMany {
        return $this->hasMany(
            related: Borrow::class,
            foreignKey: 'user_id'
        );
    }
}
