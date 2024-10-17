<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => [
                'required',
                'min:8',             // Minimum 8 characters
            ]
        ]);

        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))->with("error", "Login failed.Please! try again😔");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerPost(Request $request)
    {

        $request->validate([
            "fullname" => "required|min:5",  // Full name must be at least 3 characters
            "email" => "required|email|unique:users,email",  // Ensures the email is unique in the 'users' table
            "password" => [
                'required',
                'string',
                'min:8',             // Minimum 8 characters
               // 'regex:/[A-Z]/',     // Must contain at least one uppercase letter
               // 'regex:/[0-9]/',     // Must contain at least one number
            ]
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return redirect(route("login"))->with("success", "User is created successfully🎉🎉🎉");
        }
        return redirect(route("register"))->with("error", "Ops! Failed to create user account.");
    }
}
