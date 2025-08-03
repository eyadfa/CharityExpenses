<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, UuidTrait;
    protected $fillable=["id","title","controller_id", "page_id","caption"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }

    public function users() {
        return $this->belongsToMany(User::class,'users_permissions');
    }

    function controller(){
        return $this->belongsTo(Controller::class, "controller_id" ,"id");
    }

    function page(){
        return $this->belongsTo(Functions::class, "page_id" ,"id");
    }
}
