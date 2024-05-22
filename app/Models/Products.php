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

    public function __construct()
    {
        $this->table = 'product';
    }

    public function select_pro()
    {
        return DB::table($this->table)
            // ->select('product.*', 'name_category as name_cate')
            // ->join('category', 'product.category_id', '=', 'category.id')
            // ->9where(function($query){
            // $query->orwhere()
            // })
            // ->limit($limit)
            ->orderBy('id', 'DESC')
            // ->get();
            ->paginate(20);
    }

    public function insert_Pro($name, $quantity, $price, $mota, $img, $cate_id)
    {
        DB::table($this->table)->insert([
            'name_sp' => $name,
            'soluong' => $quantity,
            'price' => $price,
            'mota' => $mota,
            'img' => $img,
            'category_id' => $cate_id,
        ]);
    }

    public function select_Pro_where($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    public function updatePro($id, $name, $quantity, $price, $mota, $img, $cate_id)
    {
        DB::table($this->table)->where('id', $id)->update([
            'name_sp' => $name,
            'soluong' => $quantity,
            'price' => $price,
            'mota' => $mota,
            'img' => $img,
            'category_id' => $cate_id

        ]);
    }

    public function deletePro($id)
    {
        DB::table($this->table)->delete($id);
    }
}
