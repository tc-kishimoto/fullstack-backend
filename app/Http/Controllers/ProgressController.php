<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function getProgress(Request $request)
    {
        $progress = Progress::where('user_id', $request->user()->id)
        ->where('category', $request->category)
        ->where('title', $request->title)
        ->first();

        return response([
            'progress' => $progress === null ? 0 : $progress->progress
        ], 200);
    }

    public function updateProgress(Request $request)
    {
        $progress = Progress::where('user_id', $request->user()->id)
        ->where('category', $request->category)
        ->where('title', $request->title)
        ->first();

        if(!$progress) {
            $progress = new Progress();
            $progress->user_id = $request->user()->id;
            $progress->category = $request->category;
            $progress->title = $request->title;
        }

        $progress->progress = $request->progress;
        $progress->save();
    }

    public function getCategoryProgress(Request $request)
    {
        $result = Progress::where('user_id', $request->user()->id)
        ->where('category', $request->category)
        ->get();
        return response($result, 200);
    }

    public function getAchivement(Request $request)
    {
        $result = DB::select(DB::raw("
        select c.category, fullPage, ifnull(count, 0) progressPage
        from (
        select category, count(*) fullPage
        from search_contents
        where instr(title, '練習問題') = 0
        and instr(title, '演習問題') = 0
        and instr(title, '単元課題') = 0
        group by category) c
        left join (
        select category, count(*) count
        from progresses
        where user_id = " . $request->user_id ."
        group by category
        ) p
        on c.category = p.category
        "));
        return response($result, 200);
    }
}
