<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemSettings extends Model
{
    use HasFactory,UuidTrait,SoftDeletes;
    protected $table="system_settings";
    protected $fillable=[ "key", "value", "notes", "is_active", "created_by", "updated_by"];
    protected $casts=[
        "created_at"=>"datetime:Y-m-d",
        "updated_at"=>"datetime:Y-m-d",
        "is_active"=>"boolean",
    ];
}
