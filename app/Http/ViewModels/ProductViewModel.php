<?php

namespace App\Http\ViewModels;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;

class ProductViewModel
{

    public $product;
    public function __construct(Products $products = null)
    {
        $this->product = $products;
    }

    public function product()
    {
    }

    public function categories(): Collection
    {
        return Category::all();
    }
}
