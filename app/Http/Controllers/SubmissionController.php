<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function search(Request $request) {
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
}