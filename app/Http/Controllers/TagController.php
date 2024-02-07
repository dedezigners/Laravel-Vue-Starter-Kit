<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\TagRequest;
use App\Http\Resources\Blog\TagResource;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->get();
        $trashedTags = Tag::onlyTrashed()->get();
        return Inertia::render('Admin/Blog/Tags', [
            'tags' => TagResource::collection($tags),
            'trashed-tags' => TagResource::collection($trashedTags),
        ]);
    }

    public function store(TagRequest $request)
    {
        $data = $request->all();
        $tag = Tag::create(array_merge($data, [
            'user_id' => auth()->id(),
        ]));
        return new TagResource($tag);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->only('name', 'slug', 'parent', 'desc');
        $tag->update($data);
        return new TagResource($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(true);
    }

    public function restore($id)
    {
        $tag = Tag::onlyTrashed()->find($id);
        $tag->restore();
        return response()->json(true);
    }
    
    public function permanentDelete($id)
    {
        $tag = Tag::onlyTrashed()->find($id);
        $tag->forceDelete();
        return response()->json(true);
    }
}
