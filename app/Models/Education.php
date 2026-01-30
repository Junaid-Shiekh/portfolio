<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'degree',
        'institution',
        'field_of_study',
        'start_date',
        'end_date',
        'is_current',
        'cgpa',
        'order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];
}
