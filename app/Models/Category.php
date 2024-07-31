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
}
