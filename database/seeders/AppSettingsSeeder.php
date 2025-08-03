<?php

namespace Database\Seeders;


use App\Models\SystemSettings;
use Illuminate\Database\Seeder;
class AppSettingsSeeder extends Seeder
{
    public function run(){
        SystemSettings::create([
            'key'=>"prisoner_male_cantena" ,
            "value"=>250 ,
            "is_active"=>1 ,
            "notes"=>"مصروف الكنتينا الشهري للأسرى الرجال" ,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);

        SystemSettings::create([
            'key'=>"meetings_partners_part_1" ,
            "value"=>100 ,
            "is_active"=>1 ,
            "notes"=>"مبلغ الكنتينا الشهري للأسرى الاناث" ,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);


        SystemSettings::create([
            'key'=>"meetings_external_partner_2" ,
            "value"=>"قسم 2" ,
            "is_active"=>1 ,
            "notes"=>"اجتماعات المؤسسات الشريكة - قسم 2" ,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);
        SystemSettings::create([
            'key'=>"meetings_external_partner_3" ,
            "value"=>"قسم 3" ,
            "is_active"=>1 ,
            "notes"=>"اجتماعات المؤسسات الشريكة - قسم 3" ,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);
        SystemSettings::create([
            'key'=>"meetings_external_partner_4" ,
            "value"=>"قسم 1" ,
            "is_active"=>1 ,
            "notes"=>"اجتماعات المؤسسات الشريكة - قسم4 " ,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);
        SystemSettings::create([
            'key'=>"meetings_external_partner_4" ,
            "value"=>"قسم 4" ,
            "is_active"=>1 ,
            "notes"=>"اجتماعات المؤسسات الشريكة - قسم 4" ,
            "created_by"=>1 ,
            "updated_by"=>1
        ]);


    }
}
