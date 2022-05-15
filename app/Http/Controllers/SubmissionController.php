<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
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

    public function getSubmissions(Request $request)
    {
        $model = Submission::select(
            DB::raw('users.name user_name')
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
        $submission = Submission::create([
            'user_id' => $request->user()->id,
            'category' => $request->category,
            'lesson_name' => $request->lesson_name,
            'comment' => $request->comment,
        ]);

        return response($submission, 200);
    }

    public function delete(Request $request)
    {
        $submission = Submission::find($request->id);
        $submission->delete();
        return response([], 200);
    }
}
