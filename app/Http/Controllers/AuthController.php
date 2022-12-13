<?php


namespace App\Http\Controllers;


use App\Http\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('auth.register');
    }

    public function signUp(SignupRequest $request)
    {
        if (!$request->validator->fails()) {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['success' => 1]);
        }
        return response()->json(['success' => 0]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
