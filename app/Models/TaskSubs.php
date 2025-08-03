<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskSubs extends Model
{
    use HasFactory , SoftDeletes,UuidTrait;

    protected $table="tasks_subs";
    protected $fillable=[ "task_id", "title", "start_date", "due_date", "is_finished", "finish_note", "finished_at",
        "details", "created_by", "assigned_to"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'due_date' => 'datetime:Y-m-d',
        'start_date' => 'datetime:Y-m-d',
        'finished_at' => 'datetime:Y-m-d',
        'is_finished' => 'boolean',
    ];

    function participant(){
        return $this->hasOne(TaskParticipants::class, "id" , "assigned_to")->withDefault(new TaskParticipants());
    }
}
