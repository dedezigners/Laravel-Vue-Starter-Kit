<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Trait\FileUploadTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FrontendController extends Controller
{
    use FileUploadTrait;
    
    public function index()
    {
        return Inertia::render('App/Home');
    }

    public function dashboard()
    {
        return Inertia::render('App/Dashboard');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image'],
            'type' => ['required', 'string'],
            'filename' => ['nullable', 'string'],
        ]);

        return $this->saveFile($request, $request->type, $request->filename);
    }
}
