<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render("Admin/Blog/Posts");
    }
    
    public function create()
    {
        return Inertia::render("Admin/Blog/CreatePost", [
            'title' => "Create Post"
        ]);
    }
}