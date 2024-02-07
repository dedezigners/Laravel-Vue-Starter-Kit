<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CategoryRequest;
use App\Http\Resources\Blog\CategoryResource;
use App\Models\Blog\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $trashedCategories = Category::onlyTrashed()->latest()->get();
        return Inertia::render('Admin/Blog/Categories', [
            'categories' => CategoryResource::collection($categories),
            'trashedCategories' => CategoryResource::collection($trashedCategories),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::create(array_merge($data, [
            'user_id' => auth()->id(),
        ]));
        return new CategoryResource($category);
    }
    
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->only('name', 'slug', 'parent', 'desc');
        $category->update($data);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(true);
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->restore();
        return response()->json(true);
    }
    
    public function permanentDelete($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        return response()->json(true);
    }
}
