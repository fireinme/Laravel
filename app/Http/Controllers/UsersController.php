<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store', 'index']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //首页展示全部用户
    public function index()
    {
        $users = User::paginate(10);
        return view('users/index', compact('users'));

    }

    //注册用户
    public function create()
    {
        return view('users/create');
    }

    //展示用户信息
    public function show(User $user)
    {
        return view('users/show', compact('user'));
    }

    //验证并存贮验证信息
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:3',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', $user);
    }

    //编辑用户信息
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //更新用户信息
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $this->authorize('update', $user);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料更改成功');
        return redirect()->route('users.show', $user->id);
    }

    //删除用户

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '删除用户成功！');
        return back();
    }
}
