<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;

class Lecturer extends Authenticatable implements FilamentUser
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'nip',
        'name',
        'photo',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $panel->getId() === 'lecturer';
    }
}
