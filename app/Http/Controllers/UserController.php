<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function changeRole($id, $newRole) {
        $user = User::findOrFail($id);
        $user->role = $newRole;
        $user->save();

        return redirect()->back()->with('success', "Changed role of user " . $user->name . " to " . $newRole);
    }
}
