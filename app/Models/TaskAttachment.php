<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskAttachment extends Model
{
    use HasFactory , SoftDeletes, UuidTrait;

    protected $table="tasks_attachments";
    protected $fillable=[  "task_id", "path", "note", "created_by"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    function creator(){
        return $this->hasOne(User::class, "id" , "created_by")->withDefault(new User());
    }
}
