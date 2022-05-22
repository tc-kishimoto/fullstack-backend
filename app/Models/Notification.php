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

    protected $appends = ['link_title', 'link', 'explanation'];

    public function getLinkTitleAttribute()
    {
        switch($this->target_table) {
            case 'submissions':
                return '演習提出通知';
            default :
                return '';
        }
    }

    public function getLinkAttribute()
    {
        switch($this->target_table) {
            case 'submissions':
                return "/html/submissionDetail.html?id={$this->target_id}";
            default :
                return '';
        }
    }

    public function getExplanationAttribute()
    {
        $user = User::find($this->source_user_id);
        switch($this->target_table) {
            case 'submissions':
                $submission = Submission::find($this->target_id);
                return "{$user->name}さんが{$submission->category}_{$submission->lesson_name}を提出しました。";
            default :
                return '';
        }
    }
}
