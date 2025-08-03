<?php

namespace Database\Seeders;


use App\Models\City;
use Illuminate\Database\Seeder;
class CitySeeder extends Seeder
{
    public function run(){
        City::create([
            'country_id'=>1 ,
            "capital"=>1 ,
            "name"=>"القاهرة" ,
            "is_active"=>1,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);

        City::create([
            'country_id'=>1 ,
            "capital"=>0 ,
            "name"=>"العريش" ,
            "is_active"=>1,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);

        City::create([
            'country_id'=>1 ,
            "capital"=>0 ,
            "name"=>"الاسكندرية" ,
            "is_active"=>1,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);

        City::create([
            'country_id'=>2 ,
            "capital"=>1 ,
            "name"=>"القدس" ,
            "is_active"=>1,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);

        City::create([
            'country_id'=> 2,
            "capital"=>0 ,
            "name"=>"غزة" ,
            "is_active"=>1,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);

        City::create([
            'country_id'=>2 ,
            "capital"=>0 ,
            "name"=>"نابلس" ,
            "is_active"=>1,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);
    }
}
