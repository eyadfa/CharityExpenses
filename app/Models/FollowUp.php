<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use HasFactory ,UuidTrait,SoftDeletes;

    protected $table="followups";
    protected $fillable=["title" , "follower_id", "item_id" , "related_to","commissioning_source_cd","commissioner" ,"due_date",
        "details","notes","created_by","updated_by", "deleted_by" , "is_finished","finished_at"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'due_date' => 'datetime:Y-m-d',
    ];
    function attachments(){
        return $this->hasMany(FollowupAttachments::class , "followup_id" , "id");
    }
    function follower(){
        return $this->hasOne(Employee::class, "id" , "follower_id")->withDefault(new Employee());
    }

    function replies(){
        return $this->hasMany(FollowupReply::class , "followup_id" , "id");
    }

    function related(){
        return $this->hasOne(Code::class, "sub_cd" , "related_to")->where("main_cd" , 115);
    }

    function sourcex(){
        return $this->hasOne(Code::class, "sub_cd" , "commissioning_source_cd")->where("main_cd" , 116);
    }
    function creator(){
        return $this->hasOne(User::class, "id" , "created_by")->withDefault(new User());
    }
}
