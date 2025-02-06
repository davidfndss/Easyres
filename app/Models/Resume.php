<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'name',
        'worked_at'
    ];

    protected $casts = [
        'worked_at' => 'array',
    ];
}
