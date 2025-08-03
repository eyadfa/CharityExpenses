<?php

namespace Database\Seeders;

use App\Models\Controller;
use Illuminate\Database\Seeder;
use File;

class ControllersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Controller::truncate();

        $jsonPath = database_path("data/controllers.json");
        $json = File::get($jsonPath);
        $codes = json_decode($json);

        foreach ($codes as $key => $value) {
            Controller::create([
                "id"=> $value->id ,
                "name"=> $value->name,
                "caption"=> "",
                "is_active"=> 1,
            ]);

        }
    }
}
