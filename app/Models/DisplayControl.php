<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisplayControl extends BaseModel
{
    use HasFactory;

    protected $table = 'display_control';

    protected $fillable = [
        'course_id',
        'category',
        'title',
        'display_flag',
    ];
}
