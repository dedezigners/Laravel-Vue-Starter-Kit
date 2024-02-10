<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function overview()
    {
        return Inertia::render("Admin/Profile/Overview", [
            'title' => "Profile Overview",
            'user' => new UserResource(auth()->user()),
        ]);
    }
    
    public function edit()
    {
        return Inertia::render("Admin/Profile/Edit", [
            'title' => "Profile Edit",
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
}
