<?php

namespace App\Http\Controllers\admin;

use  App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $users = Employees::all()->reject(function (Employees $users) use ($id) {
            return $users->id === $id;
        });

        return view('admin.user.index', [
            'name' => 'Employees',
            'key' => 'Home',
            'path' => '#',
            'users' => $users,
        ]);
    }

    public function login(Request $request)

    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('home');
        }
        return view('admin.login');
    }

    public function loginSubmit(UserRequest $request)
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

    public function destroy($id)
    {
        dd($id);
        Employees::deleted($id);
        return back();
    }

    public function getUser(Request $request)
    {
        $id = $request->input('query');
        $user = Employees::all()->reject(function (Employees $user) use ($id) {
            return $user->id == $id;
        })->pluck('id');
        return response()->json($user);
    }
}
