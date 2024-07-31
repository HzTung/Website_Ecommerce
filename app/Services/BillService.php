<?php

namespace App\Services;

use App\Models\Bills;
use Illuminate\Support\Facades\DB;

class BillService
{
    public function getBills()
    {
        return  Bills::all();
    }

    public function getBill_By_Id($id)
    {
        return Bills::find($id);
    }

    public function insertBill($id_kh, $date)
    {
        try {
            Bills::created([
                'id_kh' => $id_kh,
                'ngaymua' => $date,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateBill($id, $id_kh, $date)
    {
        try {
            Bills::where('id', $id)->update([
                'id_kh' => $id_kh,
                'ngaymua' => $date,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function deleteBill($id)
    {
        try {
            Bills::deleted($id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function billjoin($id_kh)
    {
        try {
            $bill = Bills::join('tbl_users',  'bills.id_kh', '=', 'tbl_users.id')
                ->join('bill_detailed',  'bills.id', '=', 'bill_detailed.id_bill')
                ->join('product', 'bill_detailed.id_sp', '=', 'product.id')
                ->where('id_kh', '=', $id_kh)
                ->select(
                    'bills.*',
                    'tbl_users.*',
                    'bill_detailed.*',
                    'product.*',
                    'bill_detailed.soluong as soluong'
                )
                ->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $bill;
    }
}
