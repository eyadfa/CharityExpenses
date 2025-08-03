<?php

namespace Database\Seeders;

use App\Models\Code;
use Illuminate\Database\Seeder;
use File;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Code::truncate();
        $jsonPath = database_path("data/codes.json");
        $json = File::get($jsonPath);
        $codes = json_decode($json);

        foreach ($codes as $key => $value) {
            Code::create([
                "main_cd"=> $value->MAIN_CD ,
                "sub_cd"=> $value->SUB_CD,
                "controller_id"=> $value->controller_id,
                "page_id"=> $value->page_id,
                "desc_ar"=> $value->ARB_DESC,
                "desc_en"=> is_null($value->ENG_DESC)?"" :$value->ENG_DESC,
                "is_active"=> 1,
                "created_by"=> 1,
                "updated_by"=> 1,
            ]);
        }

    }
}
