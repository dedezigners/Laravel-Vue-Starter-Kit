<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Trait\FileUploadTrait;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    use FileUploadTrait;
    
    public function index()
    {
        $users = User::latest()->get();
        $trashed = User::onlyTrashed()->get();
        return Inertia::render("Admin/Users", [
            'users' => UserResource::collection($users),
            'trashed-users' => UserResource::collection($trashed),
        ]);
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        $image = $this->saveFile($request, 'users', $request->username);
        if ($image) $data['image'] = $image;

        $user = User::create($data);
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->only('image', 'name', 'email', 'username', 'role',);
        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(true);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return response()->json(true);
    }
    
    public function permanentDelete($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return response()->json(true);
    }
}
