<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $attributes)
 */
class PanelMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'panel_id',
        'teacher_id'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function panel(): BelongsTo
    {
        return $this->belongsTo(Panel::class);
    }
}
