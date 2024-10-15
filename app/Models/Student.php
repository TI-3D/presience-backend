<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'nim',
        'name',
        'birth_date',
        'gender',
        'avatar',
        'photo',
        'verified',
        'user_id',
        'group_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birth_date' => 'date',
        'verified' => 'boolean',
        'user_id'=>'integer',
        'group_id' => 'integer',
    ];


    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permit::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }
}
