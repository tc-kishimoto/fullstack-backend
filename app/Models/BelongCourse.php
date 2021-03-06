<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BelongCourse extends BaseModel
{
    use HasFactory;

    protected $table = 'belong_course';

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

}
