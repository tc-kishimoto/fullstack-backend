<?php

namespace App\Http\Controllers;

use App\Models\DisplayControl;
use App\Models\SearchContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DisplayController extends Controller
{
    public function getDiplayContents(Request $request)
    {
        $result = DB::select(
            DB::raw("select s.category category
            , s.title title
            , ifnull(d.display_flag, 1) display_flag
            from search_contents s
            left join display_control d
            on s.category = d.category
            and s.title = d.title
            and d.course_id = ". $request->course_id ."
            "));
        return response($result, 200);
    }

    public function updateDisplayFlag(Request $request)
    {
        $displayControl = DisplayControl::updateOrCreate(
            [
                'course_id' => $request->course_id,
                'category' => $request->category,
                'title' => $request->title,
            ],
            [
                'display_flag' => $request->display_flag,
            ]
        );
        return response($displayControl, 200);
    }
}
