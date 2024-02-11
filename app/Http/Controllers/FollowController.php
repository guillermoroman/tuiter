<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function store(Request $request)
    {
        $userToFollow = User::findOrFail($request->user_id);
        auth()->user()->following()->attach($userToFollow);

        return back();
    }

    public function destroy(User $user)
    {
        auth()->user()->following()->detach($user);

        return back();
    }

}
