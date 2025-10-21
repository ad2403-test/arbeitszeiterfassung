<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){ 
        $validate = $request->validate([
            "email"=> "required|email|exists:users,email",
            "password"=> "required|string",
        ]);

        
        $user = User::where('email', $request->email)->first();

        if($user->password === $request->password){
            return view('users.dashboard');
        } else {
            return view('auth.login')->with('error', 'Geht nicht');
        }
    }
}

