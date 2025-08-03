<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory , UuidTrait;
    protected  $table="notifications_tb";
    protected $fillable = ["user_id", "status", "title", "body", "related_url"];
    protected $appends=["diff"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    function getDiffAttribute(){

        return $this->created_at->diffForHumans();
    }
}
