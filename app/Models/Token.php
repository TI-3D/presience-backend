<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    use HasFactory;
    protected $table = "tokens";

    protected $fillable = [
        'reftoken','student_id'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
