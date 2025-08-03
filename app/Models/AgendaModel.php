<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaModel extends Model
{
    use HasFactory,UuidTrait;
    protected $table ="agendas";
    protected $fillable=["name", "employee_id",  "address", "priority_cd", "start_date", "end_date", "details", "notes",
        "created_by", "updated_by"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];


    function priority(){
        return $this->hasOne(Code::class, "sub_cd" , "priority_cd")
            ->where("main_cd" , 113)->withDefault(new Code());
    }
}
