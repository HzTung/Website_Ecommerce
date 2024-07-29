<?php

namespace App\Services;

use App\Models\Products;

class ProductService
{
    public function createProduct(array $data)
    {
        return Products::create($data);
    }

    // Add more service methods as needed
}
