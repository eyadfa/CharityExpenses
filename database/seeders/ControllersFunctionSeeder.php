<?php

namespace Database\Seeders;

use App\Models\Functions;
use Illuminate\Database\Seeder;
use File;

class ControllersFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Functions::truncate();

        $jsonPath = database_path("data/controllers_functions.json");
        $json = File::get($jsonPath);
        $codes = json_decode($json);

        foreach ($codes as $key => $value) {
            Functions::create([
                "id"=> $value->id ,
                "controller_id"=> $value->controller_id ,
                "name"=> $value->name,
                "caption"=> "",
                "is_active"=> 1,
            ]);
        }
    }
}
