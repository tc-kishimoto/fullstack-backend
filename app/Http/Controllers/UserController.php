<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function login(Request $request) {
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
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response($user, 200);
    }
}
