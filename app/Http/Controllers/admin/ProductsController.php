<?php

namespace App\Http\Controllers\admin;

use App\Http\ViewModels\ProductViewModel;
use App\Models\Category;
use App\Models\Products;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $productService, $categoryService, $productViewModel;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->categoryService = new CategoryService();
        $this->productViewModel = new ProductViewModel();
    }
    public function index()
    {
        $listCate = $this->categoryService->getCate();
        $ListProduct = Products::paginate(4);
        $title = 'Xóa sản phẩm';
        $text = "Bạn có chắc muốn xóa?";
        confirmDelete($title, $text);
        return view('admin.products.index', [
            'name' => 'Danh Muc',
            'key' => 'Home',
            'path' => '#',
            'listProduct' => $ListProduct,
            'listCate' => $listCate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateAll = $this->categoryService->getCate();
        return view('admin.products.add', [
            'name' => 'Sản Phẩm',
            'key' => 'ADD',
            'path' => '#',
            'cateAll' => $cateAll,
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
        $arr = $request->all();
        $rules = [
            'name_sp' => 'required|unique:product',
            'quantity' => 'required|min:0|integer',
            'price' => 'required|integer',
            'mota' => 'required',
            'img' => '',
            'cate' => 'required'
        ];

        $messages = [
            'required' => ':attribute không được để trống ',
            'min' => ':attribute phải lớn hơn :min',
            'integer' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
        ];

        $attributes = [
            'name_sp' => 'Tên sản phẩm',
            'quantity' => 'Số lượng',
            'price' => 'Giá sản phẩm',
            'mota' => 'Mô tả',
            'img' => 'Hình ảnh',
            'cate' => 'Tên danh mục'
        ];


        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $fileName = $request->file('img')->getClientOriginalName();

            $request->img->move('uploads/', $fileName); //save in public

            // $name = $request->img->storeAs('public/uploads/', $fileName); // save in storege

            $this->productService->insert_Pro($arr['name_sp'], $arr['quantity'], $arr['price'], $arr['mota'], $fileName, $arr['cate']);
            Alert::success('Thêm sản phẩm thành công!');
            return redirect()->route('homeProduct')->with('msg', 'Nhập dữ liệu thành công');
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
        session()->put('id', $id);
        $cateAll = $this->categoryService->getCate();
        $pro = $this->productService->select_Pro_where($id);
        $getCate_id = $this->categoryService->select_Cate_Where($pro->category_id);
        return view('admin.products.edit', [
            'name' => 'Sản Phẩm',
            'key' => 'Edit',
            'path' => '#',
            'id' => $id,
            'cateAll' => $cateAll,
            'ProById' => $pro,
            'cateById' => $getCate_id
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
        $id = session('id');

        $arr = $request->all();
        $rules = [
            'name_sp' => 'required',
            'soluong' => 'required|min:0|integer',
            'price' => 'required|integer',
            'mota' => 'required',
            'img' => '',
            'category_id' => 'required'
        ];

        $messages = [
            'required' => ':attribute không được để trống ',
            'min' => ':attribute phải lớn hơn :min',
            'integer' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
        ];

        $attributes = [
            'name_sp' => 'Tên sản phẩm',
            'soluong' => 'Số lượng',
            'price' => 'Giá sản phẩm',
            'mota' => 'Mô tả',
            'img' => 'Hình ảnh',
            'category_id' => 'Tên danh mục'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $validatedData = $validator->validated();
            if ($request->hasFile('img')) {
                $fileName = $request->file('img')->getClientOriginalName();
                $request->img->move('uploads/', $fileName);
                $validatedData['img'] = $fileName;
            }

            Products::where('id', $id)->update($validatedData);
            Alert::success('Sửa sản phẩm thành công!');
            return redirect()->route('homeProduct')->with('msg', 'Sửa liệu thành công');
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
        $this->productService->deletePro($id);
        return back()->with('msg', 'Xóa dữ liệu thành công');
    }
}
