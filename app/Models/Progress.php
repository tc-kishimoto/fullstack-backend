<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends BaseModel
{
    use HasFactory;

    protected $table = 'progresses';

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'progress',
    ];
}
