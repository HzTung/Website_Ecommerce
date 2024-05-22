<?php

namespace App\Http\Controllers\admin;

use  App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'name' => 'Employees',
            'key' => 'Home',
            'path' => '#',
        ]);
    }

    public function login(Request $request)

    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('home');
        }
        return view('admin.login');
    }

    public function loginSubmit(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('admin')->attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $user = Employees::where('email', $email)->first();
            Auth::guard('admin')->login($user);
            return redirect(route('home'));
        }
        return back()->with('msg', 'Người dùng không tồn tại');
    }

    public function createUser()
    {
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    public function check_status(Request $request)
    {
        $id = $request->input('id_user');

        Employees::where('id', $id)->update([
            'status' => 'offline',
        ]);
    }
}
