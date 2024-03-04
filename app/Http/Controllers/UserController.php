<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Quyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $currentUserId = auth()->id();
        $user = User::where('id', '!=', $currentUserId)->get();
        return view('user', compact('user'));
    }

    public function create()
    {
        $quyen = Quyen::all();
        return view('user-add', compact('quyen'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email người dùng.',
            'email.email' => 'Tài khoản người dùng phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Tai khoản này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => 'required|min:6',
        ], $messages);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'quyen_id' => $request->quyen_id,
        ]);
        return redirect('user')->with('message', 'Thêm thông tin người dùng thành công');
    }

    public function show($id)
    {
        //
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $quyen = Quyen::all();
        return view('user-edit', compact('user', 'quyen'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email người dùng.',
            'email.email' => 'Tài khoản người dùng phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Tài khoản này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'required|min:6',
        ], $messages);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'quyen_id' => $request->quyen_id,
        ]);
        return redirect('user')->with('message', 'Thêm thông tin người dùng thành công');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user && $user->quyen->ten_quyen == 'Admin') {
            return redirect()->back()->with('error', 'Không thể xóa thông tin người dùng này');
        }

        User::destroy($id);
        return redirect()->back()->with('message', 'Xóa thành công');

    }
    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('message', 'Logout successful');
    }
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials) || Auth::check()) {
            return redirect('lichdayhoc')->with('message', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }


    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::all()->where('id', $id);
        return view('info', compact('user'));
    }

}
