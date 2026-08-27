<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->input('email');

        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            return response()->json([
                'error' => 'Email sudah terdaftar'
            ], 400);
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $email,
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json([
            'data' => 'OK'
        ], 200);
    }
}
