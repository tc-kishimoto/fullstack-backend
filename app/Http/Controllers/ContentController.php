<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchContent;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function getAllCategory()
    {
        $result = SearchContent::distinct()->select('category')->get();
        return response($result, 200);
    }

    public function search(Request $request)
    {
        $result = SearchContent::select('category', 'title'
            , DB::raw("substring(content,
            case
                when instr(content, '$request->keyword') - 50 < 0 then instr(content, '$request->keyword')
                else instr(content, '$request->keyword') - 50
            end
            , 100) explanation")
            , DB::raw("concat('../images/index/', category, '.png') img_path")
            , DB::raw("concat(category, '_', title, '.html') link")
            , DB::raw("concat(category, '_', title) link_title")
            )
        ->where('content', 'like', '%' . $request->keyword . '%')
        ->orderBy('category')
        ->orderBy('title')
        // ->limit(20)
        ->get();

        return response($result, 200);
    }
}
