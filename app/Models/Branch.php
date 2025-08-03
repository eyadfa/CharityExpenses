<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use UuidTrait;
    use SoftDeletes;

    protected  $table ="branches";
    protected $fillable=["title" , "email" , "phone" , "mobile", "is_active" , "country_id" , "city_id"
        , "current_employees_no" , "desc", "street" , "manager_id" , "address"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_active'=> 'boolean',
    ];


    function country(){
        return $this->hasOne(Country::class, "id" , "country_id");
    }


    function city(){
        return $this->hasOne(City::class, "id" , "city_id");
    }


    function manager(){
        return $this->hasOne(Employee::class, "id" , "manager_id");
    }
}
