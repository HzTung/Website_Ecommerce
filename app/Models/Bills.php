<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Bills extends Model
{
    use HasFactory;


    protected $table = 'bills';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ngaymua',
        'id_kh'
    ];
    public $incrementing = true;
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $attributes = [
        'trangthai_dh' => 1,
    ];
    public function __construct()
    {
        $this->table = 'bills';
    }

    public function getBills()
    {
        return  DB::table($this->table)->get();
    }

    public function getBill_By_Id($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    public function insertBill($id_kh, $date)
    {
        DB::table($this->table)->insert([
            'id_kh' => $id_kh,
            'ngaymua' => $date,
        ]);
    }

    public function updateBill($id, $id_kh, $date)
    {
        DB::table($this->table)->where('id', $id)->update([
            'id_kh' => $id_kh,
            'ngaymua' => $date,
        ]);
    }


    public function deleteBill($id)
    {
        DB::table($this->table)->delete($id);
    }

    public function billjoin($id_kh)
    {
        $bill = DB::table($this->table)
            ->join('tbl_users', $this->table . '.id_kh', '=', 'tbl_users.id')
            ->join('bill_detailed', $this->table . '.id', '=', 'bill_detailed.id_bill')
            ->join('product', 'bill_detailed.id_sp', '=', 'product.id')
            ->where('id_kh','=',$id_kh)
            ->select(
                $this->table . '.*',
                'tbl_users.*',
                'bill_detailed.*',
                'product.*',
                'bill_detailed.soluong as soluong'
            )
            ->get();

        return $bill;
    }
}
