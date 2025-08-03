<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\RolePermissions;
use App\Models\UserRole;

class RoleSeeder extends Seeder
{

    public function run(){
        Role::truncate();
        RolePermissions::truncate();
        UserRole::truncate();
        Role::create([
            "id"=>"1",
            "title"=>"مدير"
        ]);

        Role::create([
            "id"=>"2",
            "title"=>"سكرتير"
        ]);

        for($i=1;$i<10;$i++){
            RolePermissions::create([
                "role_id" =>1,
                "permission_id"=>$i
            ]);
        }

        for($i=5;$i<10;$i++){
            RolePermissions::create([
                "role_id" =>2,
                "permission_id"=>$i
            ]);
        }
        UserRole::create([
            "user_id"=>1 ,
            "role_id"=>1
        ]);
    }
}
