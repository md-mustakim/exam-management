<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
