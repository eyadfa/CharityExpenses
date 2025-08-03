<?php

namespace App\Models;

use App\Http\Controllers\API\Settings\FunctionsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $table='codes_tb';
    protected $fillable=[
        "controller_id",
        "page_id",
        "main_cd",
        "sub_cd",
        "desc_ar",
        "desc_en",
        "is_active",
        "created_by",
        "updated_by"
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        "is_active"=>"boolean",
    ];

    function parent(){
        return $this->hasOne(Code::class, "main_cd" , "main_cd")->where("sub_cd" , 0);
    }

    function controller(){
        return $this->belongsTo(Controller::class, "controller_id" ,"id");
    }

    function page(){
        return $this->belongsTo(Functions::class, "page_id" ,"id");
    }


}
