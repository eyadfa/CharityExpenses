<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    use HasFactory;
    use UuidTrait;

    protected  $table ="board_member_tb";
    protected $fillable=[ "fname", "sname", "thname", "lname", "id_card", "passport", "dob", "nationality_cd", "gender_cd", "is_active", "country_id", "city_id",
        "current_address", "current_job", "job_description", "phone", "mobile", "email", "start_date", "end_date",
        "major_cd", "academic_degree_cd",
        "graduation_country_id", "university_cd", "desc", "image_path"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_active'=> 'boolean',
    ];
    protected $appends=['full_name'];


    function country(){
        return $this->hasOne(Country::class, "id" , "country_id");
    }

    function nationality(){
        return $this->hasOne(Code::class, "sub_cd" , "nationality_cd")->where("main_cd" , 61);
    }


    function gender(){
        return $this->hasOne(Code::class, "sub_cd" , "gender_cd")->where("main_cd" , 103);
    }

    function academic_degree(){
        return $this->hasOne(Code::class, "sub_cd" , "academic_degree_cd")
            ->where("main_cd" , 5);
    }

    function getFullNameAttribute(){
        return $this->fname .' ' . $this->lname;
    }



}
