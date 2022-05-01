<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
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
