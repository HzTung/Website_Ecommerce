<?php

namespace App\Http\Controllers\clients;

use App\Models\Category;
use App\Models\Comments;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;


class HomePage extends Controller
{
    protected $categoryService,  $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        $getCate = $this->categoryService->getCate();
        $getPro = $this->productService->select_pro();
        return view('clients.index', [
            'CateAll' => $getCate,
            'proAll' => $getPro
        ]);
    }

    public function ProDetails(Request $request)
    {

        $id = $request->id;
        $getCate = $this->categoryService->getCate();
        $pro = $this->productService->select_Pro_where($id);
        $proAll = Products::where('category_id', $pro->category_id)->get();
        $prosCollection = collect($proAll);
        $filteredPros = $prosCollection->reject(function ($proAll) use ($id) {
            return $proAll['id'] == $id;
        });


        $comment = Comments::where('name_pro', '=', $pro->name_sp)->get();
        return view('clients.pro-details', [
            'CateAll' => $getCate,
            'product' => $pro,
            'valueCmt' => $comment,
            'proAll' => $filteredPros,
        ]);
    }

    function addCmt(Request $request)
    {
        $cmt = Comments::create($request->all());
        return back();
    }


    function ListProduct($id = '')
    {
        $name = 'Tất cả sản phẩm';
        $getCate = $this->categoryService->getCate();
        if ($id !== '') {
            $cate = $this->categoryService->select_Cate_Where($id);
            $name = $cate['name_category'];
            $getPro = Products::where('category_id', $id)->paginate(20);
        } else {
            $getPro = $this->productService->select_pro();
        }
        return view('clients.listproduct', [
            'name' => $name,
            'CateAll' => $getCate,
            'proAll' => $getPro
        ]);
    }

    function  ProductByCate(Request $request, $id)
    {
        $getCate = $this->categoryService->getCate();
        $idCate = $request->id;
        $proAll =  Products::where('id', $idCate)->get();

        return view(
            'clients.pro-cate',
            [
                'CateAll' => $getCate,
                'proAll', $proAll
            ]
        );
    }

    function search(Request $request)
    {
        $search = $request->input('search_value');
        $getCate = $this->categoryService->getCate();
        $results = Products::where('name_sp', 'LIKE', '%' . $search . '%')->paginate(4);
        return view('clients.search', [
            'search' => $search,
            'name' => 'Tìm sản phẩm',
            'CateAll' => $getCate,
            'proAll' => $results
        ]);
    }
}
