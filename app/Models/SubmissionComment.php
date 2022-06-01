<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubmissionComment extends BaseModel
{
    use HasFactory;

    protected $table = 'submission_comments';

    protected $fillable = [
        'submission_id',
        'user_id',
        'comment',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
