<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = 'teacher';

    protected $fillable = [
        'name', 'email', 'phone', 'designation', 'password'
    ];

    protected $hidden = ['password'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

}
