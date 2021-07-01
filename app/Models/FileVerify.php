<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $attributes)
 */
class FileVerify extends Model
{
    use HasFactory;

    protected $fillable = ['panel_course', 'teacher_id', 'panel_id'];

    public function teacher(): BelongsTo
    {
        return $this->BelongsTo(Teacher::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
