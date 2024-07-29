<?php

namespace App\Http\Controllers\clients;

use App\Models\Category;
use App\Models\Comments;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class HomePage extends Controller
{
    // protected $cate_model, $product_model;
    public function __construct()
    {
        // $this->cate_model = new Category();
        // $this->product_model = new Products();
    }

    public function index()
    {
        $getCate = Category::getCate();
        $getPro = $this->product_model->select_pro();
        return view('clients.index', [
            'CateAll' => $getCate,
            'proAll' => $getPro
        ]);
    }

    public function ProDetails(Request $request)
    {

        $id = $request->id;
        $getCate = $this->cate_model->getCate();
        $pro = $this->product_model->select_Pro_where($id);
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
        $getCate = $this->cate_model->getCate();
        if ($id !== '') {
            $cate = Category::where('id', $id)->first();
            $name = $cate['name_category'];
            $getPro = Products::where('category_id', $id)->paginate(20);
        } else {
            $getPro = $this->product_model->select_pro();
        }
        return view('clients.listproduct', [
            'name' => $name,
            'CateAll' => $getCate,
            'proAll' => $getPro
        ]);
    }

    function  ProductByCate(Request $request, $id)
    {
        $getCate = $this->cate_model->getCate();
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
        $getCate = $this->cate_model->getCate();
        $results = Products::where('name_sp', 'LIKE', '%' . $search . '%')->paginate(4);
        return view('clients.search', [
            'search' => $search,
            'name' => 'Tìm sản phẩm',
            'CateAll' => $getCate,
            'proAll' => $results
        ]);
    }
}
