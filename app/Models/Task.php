<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory , SoftDeletes ,UuidTrait;

    protected $table="tasks";
    protected $fillable=[ "title", "commissioning_source_cd", "commissioner", "priority_cd", "start_date", "due_date",
        "is_finished", "finish_note", "finished_by", "finished_at", "details","created_by","updated_by"];

    protected $with=["attachments" , "notes" ,"participants" , "sub_tasks", "priority" ,"source" ,"creator"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'start_date' => 'datetime:Y-m-d',
        'due_date' => 'datetime:Y-m-d',
        'finished_at' => 'datetime:Y-m-d',
    ];


    function attachments(){
        return $this->hasMany(TaskAttachment::class , "task_id" , "id");
    }

    function notes(){
        return $this->hasMany(TaskNotes::class , "task_id" , "id");
    }

    function participants(){
        return $this->hasMany(TaskParticipants::class , "task_id" , "id");
    }

    function sub_tasks(){
        return $this->hasMany(TaskSubs::class , "task_id" , "id");
    }


    function priority(){
        return $this->hasOne(Code::class, "sub_cd" , "priority_cd")->where("main_cd" , 113);
    }

    function source(){
        return $this->hasOne(Code::class, "sub_cd" , "commissioning_source_cd")->where("main_cd" , 116);
    }
    function creator(){
        return $this->hasOne(User::class, "id" , "created_by")->withDefault(new User());
    }



}
