<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends BaseModel
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
            case 'submission_comments':
                return '演習コメント通知';
            default :
                return '';
        }
    }

    public function getLinkAttribute()
    {
        switch($this->target_table) {
            case 'submissions':
                return "/html/submissionDetail.html?id={$this->target_id}";
            case 'submission_comments':
                $sc = SubmissionComment::find($this->target_id);
                $id = $sc !== null ? $sc->submission_id : -1;
                return "/html/submissionDetail.html?id={$id}";
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
                return $submission !== null ? "{$user->name}さんが{$submission->category}_{$submission->lesson_name}を提出しました。日時：{$submission->created_at}" : "";
            case 'submission_comments':
                $sc = SubmissionComment::find($this->target_id);
                if($sc) {
                    $submission = Submission::find($sc->submission_id);
                    return $submission !== null ? "{$user->name}さんが{$submission->category}_{$submission->lesson_name}にコメントしました。日時：{$sc->created_at}" : "";
                } else {
                    return "";
                }
            default :
                return '';
        }
    }
}
