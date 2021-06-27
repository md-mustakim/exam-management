<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $attributes)
 */
class Panel extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'name', 'description', 'code'];

    public function member(): HasMany
    {
        return $this->hasMany(PanelMember::class);
    }

    public function course(): HasMany
    {
        return $this->hasMany(PanelCourse::class);
    }
}
