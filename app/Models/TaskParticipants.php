<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskParticipants extends Model
{
    use HasFactory , SoftDeletes, UuidTrait;

    protected $table="tasks_participants";
    protected $fillable=[ "task_id", "is_internal", "participant_id", "participant_name", "created_by"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_internal' => 'boolean',
    ];

    function creator(){
        return $this->hasOne(User::class, "id" , "created_by")->withDefault(new User());
    }

    function employee(){
        return $this->hasOne(Employee::class, "id" , "participant_id")->withDefault(new Employee());
    }
}
