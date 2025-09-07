<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::paginate(10);
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $requested_data = $request->only(['name', 'email', 'password', 'role', 'created_by']);
            User::create($requested_data);
            return redirect()->route("admin.users.index")->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $requested_data = $request->only(['name', 'email', 'password', 'role', 'created_by']);
            $user->update($requested_data);
            return redirect()->route("admin.users.index")->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route("admin.users.index")->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }
}
