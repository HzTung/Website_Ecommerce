<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillsDetail extends Model
{
    use HasFactory;


    protected $table = 'bill_detailed';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_bill',
        'id_sp',
        'dongia',
        'tinhtrang_sp',
        'size',
        'soluong',
    ];
    public $incrementing = true;
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $attributes = [
        'tinhtrang_sp' => 1,
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public function __construct()
    {
        $this->table = 'bill_detailed';
    }


    public function getBillDetail()
    {
        $data = DB::table($this->table)->get();
        return $data;
    }
}
