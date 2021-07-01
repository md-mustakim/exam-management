<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $attributes)
 */
class PanelCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'panel_id',
        'teacher_id',
        'name',
        'file',
        'description'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
