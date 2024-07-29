<?php

namespace App\Services;

use App\Models\Products;

class ProductService
{
    public function createProduct(array $data)
    {
        return Products::create($data);
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
