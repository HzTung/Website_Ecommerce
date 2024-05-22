<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_category',
        'mota',
        'created_at',

    ];
    public $incrementing = true;
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function __construct()
    {
        $this->table = 'category';
    }

    public function getCate()
    {
        return DB::table($this->table)->get();
    }
    public function insertCate($name, $mota)
    {
        DB::table($this->table)->insert([
            'name_category' => $name,
            'mota' => $mota
        ]);
    }

    public function select_Cate_Where($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    public function updateCate($id, $name, $mota)
    {
        DB::table($this->table)->where('id', $id)->update([
            'name_category' => $name,
            'mota' => $mota,
        ]);
    }

    public function deleteCate($id)
    {
        DB::table($this->table)->delete($id);
    }
}
