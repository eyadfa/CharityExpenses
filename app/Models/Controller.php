<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controller extends Model
{
    use HasFactory;
    protected $table="controllers_tb";
    protected $fillable=['id','name' , "caption" ,  "is_active" ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        "is_active"=>"boolean",
    ];

    function functions(){
        return $this->hasMany(Functions::class,"controller_id" , "id");
    }
}
