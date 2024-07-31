<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Products extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_sp',
        'soluong',
        'mota',
        'price',
        'img',
        'category_id',
    ];
    public $incrementing = true;
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
