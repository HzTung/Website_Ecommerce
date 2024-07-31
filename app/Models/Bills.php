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
}
