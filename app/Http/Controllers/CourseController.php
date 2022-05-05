<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CourseController extends Controller
{
    public function all()
    {
        $result = Course::all();
        return response($result, 200);
    }

    public function create(Request $request) {
        $course = Course::create([
            'name' => $request->name
        ]);

        return response($course, 200);

    }

    public function search(Request $request) {
        $result = Course::select(
            DB::raw("'' img_path")
            , DB::raw("concat('/html/courseDetail.html?id=', id) link")
            , DB::raw("name link_title")
            , DB::raw("'' explanation")
        )
        ->where('name', 'like', '%' . $request->keyword . '%')
        ->get();
        return response($result, 200);
    }

    public function getCourseInfo(Request $request)
    {
        $result = Course::with('users.user.company')
        ->where('id', '=', $request->id)
        ->first();
        return response($result, 200);
    }
}
