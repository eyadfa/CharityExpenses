<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        User::create([
            'id'=>1,
            'name' => 'مدير الموقع',
            'email' => 'admin',
            'password' => bcrypt('12345678'),
            'department_id' => 0,
            'is_active' => 1,
            'related_emp_id'=>0,
        ]);
    }
}
