<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\BelongCourse;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function getMySubmissions(Request $request)
    {
        $result = Submission::where('id', $request->user()->id)->get();
        return response($result, 200);
    }

    public function search(Request $request)
    {
        $result = Submission::select(
            DB::raw("'' img_path")
            , DB::raw("concat(users.name, '：' ,category, lesson_name) link")
            , DB::raw("concat(users.name, '：' ,category, lesson_name) link_title")
            , DB::raw("comment explanation")
        )
        ->join('users', 'users.id', '=', 'submissions.user_id')
        // ->where()
        ->get();

        return response($result, 200);
    }

    public function getSubmission(Request $request)
    {
        $submission = Submission::with('user')
        ->find($request->id);
        return response($submission, 200);
    }

    public function getSubmissions(Request $request)
    {
        $model = Submission::select(
            DB::raw('users.id user_id')
            , DB::raw('users.name user_name')
            ,'submissions.id' ,'category', 'lesson_name', 'comment', 'submissions.url'
            , 'submissions.created_at', 'submissions.updated_at')
            ->join('users', 'users.id', '=', 'submissions.user_id')
            ->leftJoin('companies', 'companies.id', '=', 'users.company_id')
            ->leftJoin('belong_course', 'belong_course.user_id', '=', 'users.id')
            ->leftJoin('courses', 'courses.id', '=', 'belong_course.course_id');
        if($request->company_id) {
            $model->where('companies.id', '=', $request->company_id);
        }
        if($request->course_id) {
            $model->where('courses.id', '=', $request->course_id);
        }
        if($request->user_id) {
            $model->where('users.id', '=', $request->user_id);
        }
        $result = $model->get();
        return response($result, 200);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required'],
            'comment' => ['required'],
        ]);
        $submission = Submission::create([
            'user_id' => $request->user()->id,
            'category' => $request->category,
            'lesson_name' => $request->lesson_name,
            'url' => $request->url,
            'comment' => $request->comment,
        ]);

        // 通知
        $targetCourse = BelongCourse::where('user_id', $request->user()->id)->get();
        $targetUsers = BelongCourse::whereIn('course_id', $targetCourse->pluck('course_id'))
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('users.id', 'belong_course.user_id')
                  ->whereIn('role', [1, 3]); // システム管理者・コース管理者
        })->get();
        foreach($targetUsers as $user) {
            Notification::create([
                'source_user_id' => $request->user()->id,
                'target_user_id' => $user->id,
                'target_table' => 'submissions',
                'target_id' => $submission->id,
                'status' => 0,
            ]);
        }

        return response($submission, 200);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required'],
            'comment' => ['required'],
        ]);
        $submission = Submission::find($request->id);
        $submission->url = $request->url;
        $submission->comment = $request->comment;
        $submission->save();

        return response($submission, 200);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        DB::transaction(function() use ($id) {

            Notification::where('target_table', 'submissions')
            ->where('target_id', $id)
            ->delete();

            SubmissionComment::where('submission_id', $id)->delete();

            $submission = Submission::find($id);
            $submission->delete();

        });
        return response([], 200);
    }

    public function addComment(Request $request)
    {
        $result = SubmissionComment::create([
            'submission_id' => $request->id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
        ]);

        // 通知(本人以外によるコメント)
        $submission = Submission::find($request->id);
        if($request->user()->id !== $submission->user_id) {
            Notification::create([
                'source_user_id' => $request->user()->id,
                'target_user_id' => $submission->user_id,
                'target_table' => 'submission_comments',
                'target_id' => $result->id,
                'status' => 0,
            ]);
        }

        // 通知
        $targetCourse = BelongCourse::where('user_id', $request->user()->id)->get();
        $targetUsers = BelongCourse::whereIn('course_id', $targetCourse->pluck('course_id'))
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('users.id', 'belong_course.user_id')
                  ->whereIn('role', [1, 3]); // システム管理者・コース管理者
        })->get();
        // Log::debug('targetUsers', [$targetUsers]);
        foreach($targetUsers as $user) {
            if($user->user_id !== $request->user()->id) {
                Notification::create([
                    'source_user_id' => $request->user()->id,
                    'target_user_id' => $user->user_id,
                    'target_table' => 'submission_comments',
                    'target_id' => $result->id,
                    'status' => 0,
                ]);
            }
        }

        return response($result, 200);

    }

    public function getCommentList(Request $request)
    {
        $result = SubmissionComment::with('user')
        ->where('submission_id', $request->id)
        ->orderBy('created_at')
        ->get();

        return response($result, 200);
    }

    public function commentUpdate(Request $request) {
        $sc = SubmissionComment::find($request->id);
        $sc->comment = $request->comment;
        $result = $sc->save();
        return response($result, 200);
    }

    public function commentDelete(Request $request)
    {
        $id = $request->id;
        DB::transaction(function() use ($id) {
            Notification::where('target_table', 'submission_comments')
            ->where('target_id', $id)->delete();

            $sc = SubmissionComment::find($id);
            $sc->delete();
        });
        return response([], 200);
    }

    public function find($id)
    {
        $result = Submission::with('comments')->where('id', $id)
        ->first();
        return response($result, 200);
    }
}
