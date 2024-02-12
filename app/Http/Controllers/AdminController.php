<?php

namespace App\Http\Controllers;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render("Admin/Dashboard", [
            'user-count' => User::count(),
            'post-count' => Post::count(),
            'category-count' => Category::count(),
            'tag-count' => Tag::count(),
        ]);
    }
}
