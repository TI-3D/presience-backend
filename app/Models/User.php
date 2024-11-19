<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable;

use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";

    protected $fillable = [
        'username',
        'password',
        'fcm_id',
        'nim',
        'name',
        'birth_date',
        'gender',
        'avatar',
        'photo',
        'verified',
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
        'user_id' => 'integer',
        'group_id' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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
    // public function getAuthIdentifierName()
    // {
    //     // return 'username';
    // }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        $major = "";
        if (isset($this->group_id)) {
            $group = Group::find($this->group_id);
            if ($group && isset($group->name)) {
                if (str_contains($group->name, 'TI')) {
                    $major = "Teknik Informatika";
                } elseif (str_contains($group->name, 'SIB')) {
                    $major = "Sistem Informasi Bisnis";
                }
            }
        }
        $birth_date = Carbon::parse($this->birth_date)->translatedFormat('d F Y');
        return [
            "data" => [
                'id' => $this->id,
                'username' => $this->username,
                'nim' => $this->nim,
                'name' => $this->name,
                'birth_date' => $birth_date,
                'gender' => $this->gender,
                'avatar' => $this->avatar,
                'major' => $major,
                'semester' => $this->semester,
                'group' => [
                    'group_id'=>$group->id,
                    'name'=>$group->name],
                'verified' => $this->verified,
            ]
        ];
    }
}
