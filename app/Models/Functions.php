<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    use HasFactory;
    protected $table="controllers_functions_tb";
    protected $fillable=['name','is_active','controller_id' , "caption" ];

    protected $with=["controller"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        "is_active"=>"boolean",
    ];

    public function controller(){
        return $this->hasOne(Controller::class , "id" , "controller_id");
    }
}
