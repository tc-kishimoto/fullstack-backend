<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Consts\UserConst;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all()
    {
        $result = User::with('company')->get();
        return response($result, 200);
    }

    public function getUser(Request $request)
    {
        $user = User::with('company')->find($request->id);
        return response($user, 200);
    }

    public function getUserById($id)
    {
        $user = User::with('company')->find($id);
        return response($user, 200);
    }

    public function getAddInCourseTargetUser(Request $request)
    {
        $users = User::with('company')
        ->whereRaw("not exists (select * from belong_course where course_id = ? and user_id = users.id)", [$request->id])
        ->get();
        return response($users, 200);
    }

    public function search(Request $request)
    {
        $model = User::select("users.name"
            , DB::raw("icon_path img_path")
            , DB::raw("concat('/html/userDetail.html?id=', users.id) link")
            , DB::raw("users.name link_title")
            , DB::raw("concat(users.name, ', 所属企業', ifnull(companies.name, '')) explanation")
            )
            ->leftJoin('companies', 'companies.id', '=', 'users.company_id')
            ->where(DB::raw("concat(users.name, users.login_id, users.email, ifnull(companies.name, ''))"), 'like' , '%'. $request->keyword . '%');
        if($request->company_id) {
            $model->where('users.company_id', '=', $request->company_id);
        }
        if($request->user()->role === UserConst::ROLE_COMPANY_ADMIN) {
            $model->where('users.company_id', '=', $request->user()->company_id);
        }
        if($request->course_id) {
            $model->whereRaw("exists (select * from belong_course where course_id = ? and user_id = users.id)", [$request->course_id]);
        }
        // if($request->user()->role === UserConst::ROLE_COURSE_ADMIN) {
        //     $model->whereRaw("exists (select * from belong_course where course_id = ? and user_id = users.id)", [$request->course_id]);
        // }
        $result = $model->get();
        return response($result, 200);
    }

    public function login(Request $request) {
        Log::debug($request);
        if(strpos($request->email, '@')) {
            $rule = ['required', 'email'];
            $column = 'email';
        } else {
            $rule = 'required';
            $column = 'login_id';
        }
        $credentials = $request->validate([
            'email' => $rule,
            'password' => ['required'],
        ]);

        if ($column === 'email' && Auth::attempt($credentials) || $column === 'login_id') {
            $user = User::where($column, $request->email)->first();
            if($user) {
                // $token = $request->user()->createToken('my-app-token');
                $token = $user->createToken('my-app-token');

                return response([
                    'user' => $user,
                    'token' => $token->plainTextToken
                ], 200);
            }
        }

        return response([
            'MESSAGE' => '認証エラー',
        ], 400);
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }

    public function logout(Request $request)
    {
        // トークンの削除
        $request->user()->currentAccessToken()->delete();
    }

    function create(Request $request) {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'login_id' => ['required', 'unique:users'],
            'role' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'login_id' => $request->login_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $request->company_id,
        ]);
        return response($user, 200);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
            'login_id' => ['required', Rule::unique('users')->ignore($request->id)],
            'role' => ['required'],
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->name_kana = $request->name_kana;
        $user->login_id = $request->login_id;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->company_id = $request->company_id;
        $user->save();
        return response($user, 200);
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response([], 200);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find($request->user()->id)->makeVisible('password');
        if(!Hash::check($request->password, $user->password)) {
            return response(['message' => '現在のパスワードが無効です。'], 400);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response($user, 200);
    }

    public function getCompanyUsers(Request $request)
    {
        $result = User::with('company')
            ->where('company_id', $request->company_id)
            ->get();
        return response($result, 200);
    }
}
