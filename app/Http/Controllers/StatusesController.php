<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Status;

class StatusesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        //验证表单数据
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        //使用当前用户存该条字段入数据库中
        Auth::user()->status()->create([
            'content' => $request->content
        ]);
        session()->flash('success', '微博发布成功');
        return redirect()->back();
    }

    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已经成功删除');
        return redirect()->back();

    }
}
