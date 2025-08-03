<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table="departments_tb";
    protected $with=["manager"];
    protected $fillable=[
        'name_ar' ,
        "name_en" ,
        "country_id" ,
        "city_id" ,
        "address",
        "description",
        "phone",
        "manager_id",
        "is_active",
        "created_by" , "updated_by"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_active'=> 'boolean',
    ];

    public function manager(){
        return $this->hasOne(Employee::class , "id" , "manager_id")->withDefault(new Employee());
    }

}
