<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table="countries_tb";
    protected $fillable=["name","nickname","iso","iso3","created_by" , "updated_by","phone_code" , "is_active"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        "is_active"=>"boolean",
    ];
}
