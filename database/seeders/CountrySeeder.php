<?php

namespace Database\Seeders;


use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends  Seeder
{
    public function run()
    {
      /*  Country::truncate();

        $json = File::get("database/data/codes.json");
        $countries = json_decode($json);

        foreach ($countries as $key => $value) {
            Country::create([
                "name" =>"مصر",
                "nickname"=>"جمهورية مصر العربية",
                "iso"=>"eg",
                "iso3"=>"egy",
                "created_by" =>1,
                "updated_by"=>1,
                "phone_code" =>"0020",
                "is_active"=>1
            ]);
        }*/
    Country::create([
            "name" =>"مصر",
            "nickname"=>"جمهورية مصر العربية",
            "iso"=>"eg",
            "iso3"=>"egy",
            "created_by" =>1,
            "updated_by"=>1,
            "phone_code" =>"0020",
            "is_active"=>1
        ]);

        Country::create([
            "name" =>"فلسطين",
            "nickname"=>" الأراضي الفلسطينية المحتلة",
            "iso"=>"ps",
            "iso3"=>"pse",
            "created_by" =>1,
            "updated_by"=>1,
            "phone_code" =>"00970",
            "is_active"=>1
        ]);
    }
}
