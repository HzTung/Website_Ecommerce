<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;



class AuthUserController extends Controller
{
    public function __construct()
    {
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        }

        return view('clients.login');
    }

    public function loginSubmit(Request $request)
    {
        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('web')->attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $user = User::where('email', $email)->first();
            Auth::guard('web')->login($user);
            return redirect(route('homepage'));
        }
        return back()->with('msg', 'Người dùng không tồn tại');
    }

    public function signup()
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        }
        return view('clients.signup');
    }

    public function signupSubmit(UserRequest $request)
    {
        // $validator = validator::make($request->all(), [
        //     'fullname' => 'required|unique:tbl_users',
        //     'password' => 'required|min:6',
        //     'email' => 'required|email|unique:tbl_users'
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }

        // $username = $request->input('fullname');
        // $password = $request->input('password');
        // $email = $request->input('email');

        // $user = new User();
        // $user->fullname = $username;
        // $user->password = bcrypt($password);
        // $user->email = $email;
        // $user->save();

        $user = User::create($request->validated());


        Auth::guard('web')->login($user);

        return redirect()->route('homepage');
    }


    public function logout()
    {
        Auth::guard('web')->logout();
        session()->flush();
        return redirect(route('homepage'));
    }
}
