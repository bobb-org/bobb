<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string|confirmed',
            'employee_id' => 'required|foreignId',
            'active' => 'required|integer'
        ]);

        $user = Accout::create([
            'login' => $fields['login'],
            'password' => bcrypt($fields['password']),
            'employee_id' => $fields['employee_id'],
            'active' => $fields['active']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check login
        $user = Accout::where('login', $fields['login'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function me(Request $request) //return the currently authenticated user
    {
        return $request->user();
    }

    public function logout(Request $request) {
        //auth()->user()->tokens()->delete();
        Auth::user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
