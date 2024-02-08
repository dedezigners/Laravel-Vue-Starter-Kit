<?php

namespace App\Http\Controllers;

use App\Http\Resources\Blog\PostResource;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $trashedPosts = Post::onlyTrashed()->get();
        return Inertia::render("Admin/Blog/Posts", [
            'posts' => PostResource::collection($posts),
            'trashed-posts' => PostResource::collection($trashedPosts),
        ]);
    }
    
    public function create()
    {
        return Inertia::render("Admin/Blog/PostForm", [
            'title' => "Create Post"
        ]);
    }
    
    public function edit()
    {
        return Inertia::render("Admin/Blog/PostForm", [
            'title' => "Create Post"
        ]);
    }
}
