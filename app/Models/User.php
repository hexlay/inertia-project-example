<?php

namespace App\Models;

use App\Traits\ExtendsMediaInteractions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements AuditableInterface, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, Auditable, HasRoles, InteractsWithMedia, ExtendsMediaInteractions;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar',
        'is_admin',
        'current_role',
    ];

    public static array $columns = [
        'user' => 'User',
        'role' => 'Role',
    ];

    public function scopeNotInRoles(Builder $query, array $roles): Builder
    {
        return $query->whereHas('roles', function (Builder $role) use ($roles) {
            return $role->whereNotIn('name', $roles);
        });
    }

    public function currentRole(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->roles()->first()
        );
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->hasRole('Admin')
        );
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('avatar')
        );
    }
}
