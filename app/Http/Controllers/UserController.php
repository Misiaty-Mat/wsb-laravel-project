<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function changeRole($id, $newRole)
    {
        $user = User::findOrFail($id);
        $user->role = $newRole;
        $user->save();

        return redirect()->back()->with('success', "Changed role of user " . $user->name . " to " . $newRole);
    }

    public function edit($userId) {

        $currentUser = auth()->user();

        if ($currentUser->id == $userId || $currentUser->isAdmin()) {
            $user = User::findOrFail($userId);
            return view('users.edit', compact('user'));
        }

        return abort(401);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id ,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', "Successfully updated user " . $user->name);
    }

    public function destroy($userId)
    {
        User::destroy($userId);

        return redirect()->back()->with('success', "Successfully deleted user");
    }
}
