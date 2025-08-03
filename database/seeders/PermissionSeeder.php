<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use File;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        $jsonPath = database_path("data/permissions.json");
        $json = File::get($jsonPath);
        $codes = json_decode($json);
        $i=1;
        foreach ($codes as $key => $value) {
            Permission::create([
                "id"=> $i++ ,
                "title"=> $value->title ,
                "controller_id"=> $value->controller_id,
                "page_id"=> $value->page_id,
                "caption"=> $value->caption,
            ]);
        }
    }
}
