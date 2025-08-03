<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable=['auditable_type','auditable_id','event','old_values','new_values'];
    function getEventNameAttribute(){
        switch($this->event){

        }
    }
   function  getChangesAttribute(){
       $oldValues = json_decode($this>old_values, true);
       $newValues = json_decode($this->new_values, true);

       $changedAttributes = array_diff_assoc($newValues, $oldValues);
    }


    /*
     * $audits = Audit::where('auditable_type', YourModel::class)
    ->where('auditable_id', $modelId) // ID of the model instance you want to check
    ->latest()
    ->get();
     * */
}
