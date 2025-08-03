<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowupReply extends Model
{
    use HasFactory , UuidTrait;
    protected $table="followups_replies";
    protected $fillable=["followup_id", "created_by", "note"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];
    function creator(){
        return $this->hasOne(User::class, "id" , "created_by")->withDefault(new User());
    }


}
