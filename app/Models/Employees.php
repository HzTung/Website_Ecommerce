<?php

namespace App\Models;

use App\Models\Messages;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employees extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employees';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $attributes = [
        'position' => 'nhanvien',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 
     * 
     */


    public function messages()
    {
        return $this->hasMany(Messages::class);
    }


    // public function permissions()
    // {
    //     return ['category.index'];
    // }
    public function hasPermission($route): bool
    {
        $routes = $this->routes();
        return in_array($route, $routes) ? true : false;
    }

    public function routes()
    {
        $data = [];
        foreach ($this->getRoles as $role) {
            $permission = json_decode($role->permission);
            foreach ($permission as $value) {
                if (!in_array($value, $data)) {
                    array_push($data, $value);
                }
            }
        }
        return $data;
    }
    public function getRoles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'id_user', 'id_role');
    }
}
