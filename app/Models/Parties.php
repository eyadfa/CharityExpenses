<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parties extends Model
{
    use HasFactory , Auditable;

    protected $table ="parties";
    protected $fillable=[
        "name",
        "mobile",
        "manager_name",
        "activity_cd",
        "status_cd",
        "notes",
        "created_by",
        "updated_by"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];


    function status(){
        return $this->hasOne(Code::class, "sub_cd" , "status_cd")
            ->where("main_cd" , 6)->withDefault(new Code());
    }

    function activity(){
        return $this->hasOne(Code::class, "sub_cd" , "activity_cd")
            ->where("main_cd" , 4)->withDefault(new Code());
    }
}
