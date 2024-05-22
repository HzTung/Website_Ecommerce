<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillsDetail;
use Illuminate\Http\Request;
use App\Models\Bills;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $bill_model;
    public function __construct()
    {
        $this->bill_model = new Bills();
    }
    public function index()
    {
        $getBill = $this->bill_model->getBills();
        return view('admin.bills.index', [
            'name' => 'Bill',
            'key' => 'Home',
            'path' => '#',
            'listBill' => $getBill
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listBillDetail = BillsDetail::where('id_bill', $id)->get();

        return view('admin.bills.show', [
            'name' => 'Bill',
            'key' => 'Detail',
            'path' => '#',
            'listBill' => $listBillDetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bill_model->deleteBill($id);
        return back();
    }
}
