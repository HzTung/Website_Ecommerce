<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\admin\RoleRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Xóa nhóm quyền';
        $text = "Bạn có chắc muốn xóa?";
        confirmDelete($title, $text);
        $roles = Role::all();
        return view('admin.role.index', [
            'name' => 'Role',
            'key' => 'Home',
            'path' => '#',
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $routes = [];
        $all = Route::getRoutes();
        foreach ($all as $item) {
            $nameRoute = $item->getName();
            $pos = strpos($nameRoute, 'admin');
            if ($pos !== false) {
                array_push($routes, $nameRoute);
            }
        }

        return view(
            'admin.role.add',
            [
                'name' => 'Role',
                'key' => 'ADD',
                'path' => '#',
                'routes' => $routes,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->all();
        $permission = json_encode($data['checkbox']);
        try {
            $role = Role::create(
                [
                    'name' => $data['name'],
                    'permission' =>  $permission
                ]
            );
        } catch (\Throwable $th) {
        }
        Alert::success('Thêm thành công');

        return redirect()->route('admin.role.index');
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
        $routes = [];
        $all = Route::getRoutes();
        foreach ($all as $item) {
            $nameRoute = $item->getName();
            $pos = strpos($nameRoute, 'admin');
            if ($pos !== false) {
                array_push($routes, $nameRoute);
            }
        }
        $role = Role::findOrFail($id);

        return view('admin.role.edit', [
            'name' => 'Role',
            'key' => 'ADD',
            'path' => '#',
            'routes' => $routes,
            'role' => $role,
        ]);
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
        $data = $request->all();
        $permission = json_encode($data['checkbox']);
        try {
            $role = Role::where('id', $id)->update(
                [
                    'name' => $data['name'],
                    'permission' =>  $permission
                ]
            );
        } catch (\Throwable $th) {
        }
        Alert::success('Sửa thành công');
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Role::destroy($id);
            Alert::success('Xóa thành công');
            return back();
        } catch (\Throwable $th) {
        }
    }
}
