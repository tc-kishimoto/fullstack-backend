<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CourseController extends Controller
{
    public function create(Request $request) {
        $course = Course::create([
            'name' => $request->name
        ]);

        return response($course, 200);

    }

    public function search(Request $request) {
        $result = Course::select(
            DB::raw("'' img_path")
            , DB::raw("name link")
            , DB::raw("name link_title")
            , DB::raw("'' explanation")
        )
        ->where('name', 'like', '%' . $request->keyword . '%')
        ->get();

        return response($result, 200);
    }
}
