<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\BelongCourse;

class CourseController extends Controller
{
    public function all()
    {
        $result = Course::all();
        return response($result, 200);
    }

    public function getCourse(Request $request) 
    {
        $course = Course::find($request->id);
        return response($course, 200);
    }

    public function create(Request $request) 
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $course = Course::create([
            'name' => $request->name
        ]);

        return response($course, 200);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $course = Course::find($request->id);
        $course->name = $request->name;
        $course->save();

        return response($course, 200);
    }

    public function delete(Request $request)
    {
        $course = Course::find($request->id);
        $course->delete();
        return response([], 200);
    }

    public function addUser(Request $request)
    {
        foreach($request->userIds as $userId) {
            BelongCourse::create([
                'user_id' => $userId,
                'course_id' => $request->id,
            ]);
        }
        return response([], 200);
    }

    public function search(Request $request) 
    {
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
