<?php

namespace App\Services;

use App\Models\Products;

class ProductService
{
    public function select_pro()
    {
        return  Products::orderBy('id', 'DESC')->paginate(20);
    }

    public function insert_Pro($name, $quantity, $price, $mota, $img, $cate_id)
    {
        try {
            Products::create([
                'name_sp' => $name,
                'soluong' => $quantity,
                'price' => $price,
                'mota' => $mota,
                'img' => $img,
                'category_id' => $cate_id,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function select_Pro_where($id)
    {
        return  Products::find($id);
    }

    public function updatePro($id, $name, $quantity, $price, $mota, $img, $cate_id)
    {
        try {
            Products::where('id', $id)->updated([
                'name_sp' => $name,
                'soluong' => $quantity,
                'price' => $price,
                'mota' => $mota,
                'img' => $img,
                'category_id' => $cate_id
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deletePro($id)
    {
        try {
            Products::deleted($id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
