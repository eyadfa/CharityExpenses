<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table="cities_tb";
    protected $fillable=['country_id' , "capital" , "name" , "is_active", "created_by" , "updated_by"];
    protected $with=["country"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_active'=> 'boolean',
        'capital'=> 'boolean',
    ];

    function country(){
        return $this->hasOne(Country::class, "id" , "country_id");
    }
}
