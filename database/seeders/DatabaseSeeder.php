<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CodeSeeder::class,
            AppSettingsSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            ControllersSeeder::class,
            ControllersFunctionSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
