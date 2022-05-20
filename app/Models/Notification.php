<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_user_id',
        'target_user_id',
        'target_table',
        'target_id',
        'content',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $appends = ['notify_title'];

    public function getNotifyTitleAttribute()
    {
        switch($this->target_table) {
            case 'submissions':
                return '演習提出通知';
            default :
                return '';
        }
    }
}
