<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::guard('admin')->user()->id;
        $users = Employees::all()->reject(function (Employees $users) use ($id) {
            return $users->id === $id;
        });
        $title = 'Xóa nhân viên';
        $text = "Bạn có chắc muốn xóa?";
        confirmDelete($title, $text);
        return view('admin.user.index', [
            'name' => 'Employees',
            'key' => 'Home',
            'path' => '#',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.user.add', [
            'name' => 'Employees',
            'key' => 'ADD',
            'path' => '#',
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'required' => ':attribute bắt buộc nhập',
        ];

        $attributes = [
            'name' => 'Tên Danh Mục',
            'email' => 'Mô Tả',
            'password' => 'Mật khẩu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $data = $request->only(['name', 'email', 'password']);
                $user = Employees::create($data);
                if (is_array($request->role)) {
                    foreach ($request->role as $role_id) {
                        UserRole::create(['id_user' => $user->id, 'id_role' => $role_id]);
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
            Alert::success('Thêm thành công');
            return redirect(route('admin.user.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = Employees::findOrFail($id);
        $role = $user->getRoles;
        $data = [];
        foreach ($role as $item) {
            array_push($data, $item->id);
        }
        return view(
            'admin.user.edit',
            [
                'name' => 'Employees',
                'key' => 'Edit',
                'path' => '#',
                'user' => $user,
                'roles' => $roles,
                'roleChecked' => $data
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
        ];

        $messages = [
            'required' => ':attribute bắt buộc nhập',
        ];

        $attributes = [
            'name' => 'Tên Danh Mục',
            'email' => 'Mô Tả',
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data = $request->only(['name', 'email']);
            Employees::where('id', $id)->update($data);

            UserRole::where('id_user', $id)->delete();
            if (is_array($request->role)) {
                foreach ($request->role as $role_id) {
                    UserRole::create([
                        'id_user' => $id,
                        'id_role' => $role_id,
                    ]);
                }
            }
            Alert::success('Edit thành công');
            return redirect(route('admin.user.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employees::destroy($id);
        return back();
    }
}
