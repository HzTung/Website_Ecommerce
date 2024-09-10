<?php

namespace App\Http\Controllers\admin;

use App\Models\Bills;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillsDetail;

class DasboardController extends Controller
{
    public function index()
    {
        $categories = Products::selectRaw('category.name_category, COUNT(product.category_id) as countNameCate')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->groupBy('category.name_category')
            ->get()->toArray();
        $result = [[], []];
        foreach ($categories as $item) {
            $result[0][] = $item['name_category'];
            $result[1][] = $item['countNameCate'];
        }

        $price_bill_collection = collect(BillsDetail::all());
        $totalPrice = $price_bill_collection->map(function ($item) {
            return $item->dongia;
        })->sum();
        $allProduct = count(Products::all());
        $bills = Bills::all();
        $billCollection = collect($bills);
        $uniqueCustomers = $billCollection->unique('id_kh')->values();
        return view('admin.Dashboard', [
            'count' => $allProduct,
            'countCustomer' => count($uniqueCustomers),
            'totalPrice' => $totalPrice,
            'data' => $result
        ]);
    }
}
