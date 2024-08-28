<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    use HasFactory;
    protected $table = 'role_user';
    protected $fillable = ['id_user', 'id_role'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
