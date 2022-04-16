<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function getProgress(Request $request)
    {
        $progress = Progress::where('user_id', $request->user()->id)
        ->where('category', $request->category)
        ->where('title', $request->title)
        ->first()->progress;

        return response([
            'progress' => $progress
        ], 200);
    }

    public function updateProgress(Request $request)
    {
        $progress = Progress::where('user_id', $request->user()->id)
        ->where('category', $request->category)
        ->where('title', $request->title)
        ->first();

        $progress->progress = $request->progress;
        $progress->save();
    }
}
