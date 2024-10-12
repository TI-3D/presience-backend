<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermissionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_permission',
        'status',
        'permission_id',
        'schedule_week_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'permission_id' => 'integer',
        'schedule_week_id' => 'integer',
    ];

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }

    public function scheduleWeek(): BelongsTo
    {
        return $this->belongsTo(ScheduleWeek::class);
    }
}
