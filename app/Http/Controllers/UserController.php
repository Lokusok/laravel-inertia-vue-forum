<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function personal()
    {
        $user = UserResource::make(Auth::user())->resolve();

        return inertia('User/Personal', compact('user'));
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $path = Storage::disk('public')->put('/avatars', $data['avatar']);

        /** @var App\Models\User $user */
        $user = Auth::user();

        if ($user?->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update([
            'avatar' => $path
        ]);

        $path = Image::read('storage/' . $path)->resize(100, 100);
        $path->save();

        return UserResource::make(Auth::user())->resolve();
    }
}
