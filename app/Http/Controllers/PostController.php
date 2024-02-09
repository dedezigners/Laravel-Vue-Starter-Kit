<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Trait\FileUploadTrait;
use App\Http\Requests\Blog\PostRequest;
use App\Http\Resources\Blog\CategoryResource;
use App\Http\Resources\Blog\PostResource;
use App\Http\Resources\Blog\TagResource;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    use FileUploadTrait;

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
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return Inertia::render("Admin/Blog/PostForm", [
            'title' => "Create Post",
            'categories' => CategoryResource::collection($categories),
            'tags' => TagResource::collection($tags),
        ]);
    }

    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $image = $this->saveFile($request, 'posts', $request->slug);
        if ($image) $data['image'] = $image;
        
        $post = Post::create($data);
        return new PostResource($post);
    }
    
    public function edit(Post $post)
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return Inertia::render("Admin/Blog/PostForm", [
            'title' => "Edit Post",
            'categories' => CategoryResource::collection($categories),
            'tags' => TagResource::collection($tags),
            'post' => new PostResource($post),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->only('title', 'slug', 'category_id', 'tag_ids', 'excerpt', 'content', 'image');
        $post->update($data);
        
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(true);
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);
        $post->restore();
        return response()->json(true);
    }
    
    public function permanentDelete($id)
    {
        $post = Post::onlyTrashed()->find($id);
        $post->forceDelete();
        return response()->json(true);
    }
}
