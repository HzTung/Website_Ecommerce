<?php

namespace App\Services;

use App\Models\Products;

class ProductService
{

    public function select_pro()
    {
        Products::
            // ->select('product.*', 'name_category as name_cate')
            // ->join('category', 'product.category_id', '=', 'category.id')
            // ->9where(function($query){
            // $query->orwhere()
            // })
            // ->limit($limit)
            orderBy('id', 'DESC')
            // ->get();
            ->paginate(20);
    }

    public function insert_Pro($name, $quantity, $price, $mota, $img, $cate_id)
    {
        Products::insert([
            'name_sp' => $name,
            'soluong' => $quantity,
            'price' => $price,
            'mota' => $mota,
            'img' => $img,
            'category_id' => $cate_id,
        ]);
    }

    // Add more service methods as needed
}
