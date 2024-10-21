<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'photo1',
        'photo2',
        'photo3',
        'photo4',
        'photo5',
        'image_public_id1',
        'image_public_id2',
        'image_public_id3',
        'image_public_id4',
        'image_public_id5',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
