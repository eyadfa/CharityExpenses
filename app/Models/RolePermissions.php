<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="roles_permissions";
    protected $fillable=["role_id" , "permission_id"];

    /*protected $casts=[
        "permission_id"=>"string"
    ];*/
}
