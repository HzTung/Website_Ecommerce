<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\admin\CateRequests;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $cate_model;
    public function __construct()
    {
        $this->cate_model = new Category();
    }
    public function index()
    {
        $categories = $this->cate_model->getCate();
        return view('admin.categories.index', [
            'name' => 'Danh Muc',
            'key' => 'Home',
            'path' => '#',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.categories.add', [
            'name' => 'Danh Muc',
            'key' => 'ADD',
            'path' => '#',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CateRequests $cateRequests)
    {
        // userrequest để kiểm tra validation form

        $arr = $request->all();
        // $this->cate_model->insertCate($arr['name'], $arr['mota']);
        $this->cate_model->name_category = $arr['name'];
        $this->cate_model->mota = $arr['mota'];
        $this->cate_model->save();

        return redirect(route('homeCate'));
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
    public function edit($id, Request $request)
    {
        session()->put('id', $id);
        $cateById = $this->cate_model->select_Cate_Where($id);
        return view('admin.categories.edit', [
            'name' => 'Danh Muc',
            'key' => 'Edit',
            'path' => '#',
            'id' => $id,
            'cateById' => $cateById,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Lưu id vào session để bảo mật 
        $id = session('id');
        $arr = $request->all();
        $rules = [
            'name' => 'required',
            'mota' => 'required',
        ];

        $messages = [
            'required' => ':attribute bắt buộc nhập',
        ];

        $attributes = [
            'name' => 'Tên Danh Mục',
            'mota' => 'Mô Tả',
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $this->cate_model->updateCate($id, $arr['name'], $arr['mota']);
            return redirect(route('homeCate'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->cate_model->deleteCate($id);
        return redirect(route('homeCate'));
    }
}
