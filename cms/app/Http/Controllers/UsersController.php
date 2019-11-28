<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateProfileRequest;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function edit()
    {
        // routeから必須パラメーターを貰ってユーザーを取得するとgetで他のユーザープロフィールも編集できることになり、ユーザーが自分のプロフィールのみ編集可にするミドルウェアが必要になり手間がかかるので直接現在のユーザーインスタンスを渡す
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);
        session()->flash('success', 'User updated successfully.');
        return redirect()->back();
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'User was made admin successfully.');
        return redirect(route('users.index'));
    }
}
