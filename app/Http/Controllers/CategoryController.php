<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Blog/Categories');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['nullable', 'image', 'max:500'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255'],
            'desc' => ['nullable', 'string'],
            'parent' => ['nullable', 'string'],
        ]);

        return $request->all();
    }
}
