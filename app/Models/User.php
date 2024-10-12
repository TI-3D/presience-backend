<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class User extends Model
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
        'email',
        'userable_id',
        'userable_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'userable_id' => 'integer',
    ];

    public function admin(): MorphTo
    {
        return $this->morphTo();
    }

    public function student(): MorphTo
    {
        return $this->morphTo();
    }

    public function lecturer(): MorphTo
    {
        return $this->morphTo();
    }
}
