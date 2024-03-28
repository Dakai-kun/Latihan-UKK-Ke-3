<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        return view('pages.user.create');
    }
    public function store(Request $request){
        $createUser = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $createUser['password'] = bcrypt($createUser['password']);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]);

        return redirect('/dashboard/user')->with('success', 'User created successfully!');
    }

    public function edit($id){
        $user = User::find($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $updateUser = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $updateUser['password'] = bcrypt($updateUser['password']);

        User::find($id)->update($updateUser);

        return redirect('/dashboard/user')->with('success', 'User updated successfully!');
    }

    public function delete($id){
        User::find($id)->delete();
        return redirect('/dashboard/user')->with('success', 'User deleted successfully!');
    }

}
