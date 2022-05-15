<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'lesson_name',
        'url',
        'comment',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
