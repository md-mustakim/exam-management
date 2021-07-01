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

    public function verifyByStatus()
    {
        $result =  $this->hasMany(FileVerify::class, 'panel_course');
        $init = array();
        foreach ($result as $r)
        {
            array_push($init, $r->teacher_id);
        }
        $searchResult = array_search(Auth::guard('teacher')->id(), $init);
        if ($searchResult === false)
        {
            return 'verified';
        }
        return 'not verified';
    }

    public function verifyBy(): HasMany
    {
        return  $this->hasMany(FileVerify::class, 'panel_course');
    }
}
