<?php

namespace App\Models;

use App\Models\Employees;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public $incrementing = true;
    protected $fillable = ['name', 'permission'];

    // public function users()
    // {
    //     return $this->belongsToMany(Employees::class, 'role_user', 'id_role', 'id_user');
    // }
}
