<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::truncate();
        Department::create([
            'id' => 1,
            'name_ar' => 'السكرتاريا',
            'name_en' => 'secretarial',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 2,
            'name_ar' => 'الشئون الادارية',
            'name_en' => 'human resources',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 3,
            'name_ar' => 'الدائرة المالية',
            'name_en' => 'financial',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => 'm',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 4,
            'name_ar' => 'قسم الشهداء',
            'name_en' => 'Martyrs',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 5,
            'name_ar' => 'قسم الأسرى',
            'name_en' => 'Prisoners',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 6,
            'name_ar' => 'قسم الجرحى',
            'name_en' => 'ًWounded department',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 7,
            'name_ar' => 'العلاقات العامة',
            'name_en' => 'public relations',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 8,
            'name_ar' => 'المشاريع',
            'name_en' => 'Projects department',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 9,
            'name_ar' => 'قسم الاعلام',
            'name_en' => 'Media department',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 10,
            'name_ar' => 'قسم الرصد القانوني',
            'name_en' => 'Legal Monitoring department',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 11,
            'name_ar' => 'قسم التخطيط',
            'name_en' => 'Planning department',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

        Department::create([
            'id' => 12,
            'name_ar' => 'قسم الرقابة',
            'name_en' => 'Monitoring department',
            'country_id' => '1',
            'city_id' => '1',
            'address' => '',
            'description' => '',
            'phone' => '234567654',
            'manager_id' => 1,
            'is_active' => 1,
            'created_by' => 1,
        ]);

    }
}
