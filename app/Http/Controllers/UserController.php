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
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
        ]);
        try {
            $password = Hash::make($request->password);
            $user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'role' => 'Admin',
                'username' => $request->username,
            ]);
            return redirect()->route('user.create')->with('success', 'User Created Successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.create')->with('error', $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
        ]);
        try {
            if ($request->password == '') {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'role' => "Admin",
                ]);
                return redirect()->route('user.index')->with('success', 'User Updated Successfully');
            }
            $password = Hash::make($request->password);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $password,
                'role' => "Admin",
            ]);
            return redirect()->route('user.index')->with('success', 'User Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', $e->getMessage());
        }
    }
    public function delete(User $user){
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }
    public function signout(){
        auth()->logout();
        return redirect('/');
    }
}
