<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\admin\CateRequests;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $categoryService;
    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }
    public function index()
    {
        $categories = $this->categoryService->getCate();
        $title = 'Xóa danh mục';
        $text = "Bạn có chắc muốn xóa?";
        confirmDelete($title, $text);

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
    public function store(CateRequests $cateRequests)
    {
        $request = $cateRequests->all();
        $this->categoryService->insertCate($request['name_category'], $request['mota']);
        Alert::success('Success Title', 'Success Message');
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
        $cateById = $this->categoryService->select_Cate_Where($id);
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
            $this->categoryService->updateCate($id, $arr['name'], $arr['mota']);
            Alert::success('Edit thành công');
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
        $this->categoryService->deleteCate($id);
        return redirect(route('homeCate'));
    }
}
