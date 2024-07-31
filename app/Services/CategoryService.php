<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function getCate()
    {
        return Category::all();
    }
    public function insertCate($name, $mota)
    {
        try {
            Category::created([
                'name_category' => $name,
                'mota' => $mota
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function select_Cate_Where($id)
    {
        return Category::find($id);
    }

    public function updateCate($id, $name, $mota)
    {
        try {
            Category::where('id', $id)->update([
                'name_category' => $name,
                'mota' => $mota,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteCate($id)
    {
        try {
            Category::deleted($id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
