<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all()
    {
        $result = User::all();
        return response($result, 200);
    }

    public function search(Request $request)
    {
        $model = User::select("users.name"
            , DB::raw("icon_path img_path")
            , DB::raw("users.name link")
            , DB::raw("users.name link_title")
            , DB::raw("concat(users.name, ', 所属企業', companies.name) explanation")
            )
            ->leftJoin('companies', 'companies.id', '=', 'users.company_id')
            ->where(DB::raw("concat(users.name, users.login_id, users.email, companies.name)"), 'like' , '%'. $request->keyword . '%');
        if($request->company_id) {
            $model->where('users.company_id', '=', $request->company_id);
        }
        if($request->course_id) {
            $model->whereRaw("exists (select * from belong_course where course_id = ?)", [$request->course_id]);
        }
        $result = $model->get();
        return response($result, 200);
    }

    public function login(Request $request) {
        // Log::debug($request);
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
        // Log::debug($request);
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'login_id' => ['required', 'unique:users'],
            'role' => ['required'],
            'password' => ['required'],
        ]);
        // Log::debug($validated);
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
}
