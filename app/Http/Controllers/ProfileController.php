<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function overview()
    {
        return Inertia::render("Admin/Profile/Overview", [
            'title' => "Profile Overview",
            'countries' => config('dede.countries'),
            'user' => new UserResource(auth()->user()),
        ]);
    }
    
    public function edit()
    {
        return Inertia::render("Admin/Profile/Edit", [
            'title' => "Profile Edit",
            'countries' => config('dede.countries'),
            'user' => new UserResource(auth()->user()),
        ]);
    }
    
    public function changePassword()
    {
        return Inertia::render("Admin/Profile/ChangePassword", [
            'title' => "Change Password",
            'user' => new UserResource(auth()->user()),
        ]);
    }

    public function updateProfile(UserRequest $request, User $user)
    {
        $data = $request->only('image', 'name', 'email', 'username', 'role', 'phone', 'company', 'country');
        $user->update($data);

        return new UserResource($user);
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::default()],
        ]);

        $user = User::find(auth()->id());

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = $request->password;
            $user->save();

            return response()->json(['message' => "Password Changed successfully!"]);
        }

        return response()->json(['message' => "Invalid Old password!"], 400);
    }
}
