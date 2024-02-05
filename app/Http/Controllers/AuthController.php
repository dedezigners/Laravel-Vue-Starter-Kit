<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function register()
    {
        return Inertia::render('Auth/Register');
    }
    
    public function login()
    {
        return Inertia::render('Auth/Login');
    }
    
    public function forgotPassword()
    {
        return Inertia::render('Auth/ForgotPassword');
    }
    
    public function resetPassword()
    {
        return Inertia::render('Auth/ResetPassword');
    }

    public function storeRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);

        event(new Registered($user));
        Auth::login($user);
        
        return new AuthResource($user);
    }

    public function storeLogin(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return new AuthResource(auth()->user());
    }

    public function storeForgotPassword(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
        ]);

        // $login_type = filter_var($request->input('identity'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // $user = User::where($login_type, $request->get('identity'))->first();
        
        // if ($user) {
        //     // $status = Password::sendResetLink($user->email);
            
        //     // if ($status == Password::RESET_LINK_SENT) {
        //     //     return response()->json([
        //     //         "status" => __($status),
        //     //     ]);
        //     // }
        // }
        
        return response()->json([
            "message" => "We will send an email to reset your password, please check your email address linked to your account!",
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back();
    }

    public function isAuthenticated(Request $request)
    {
        if (Auth::check()) {
            return new AuthResource(Auth::user());
        }

        return null;
    }
}
