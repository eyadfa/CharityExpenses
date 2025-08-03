<?php

namespace App\Traits;

use App\Models\AuditFamilies;
use App\Models\FamMartyrData;
use App\Models\FamPrisonerData;
use App\Models\FamRelative;
use App\Models\FamRelativeAttachment;
use App\Models\FamRelativeEducation;
use App\Models\FamRelativeHealth;
use App\Models\FamRelativeReports;
use App\Models\FamRelativeTalent;

use App\Models\FamWoundedData;
use Illuminate\Support\Facades\Log;

trait AuditableFamilies
{
    public static function bootAuditableFamilies()
    {

        // Log updates only if the model exists
        static::updated(function ($model) {
            if ($model->exists) {
                $changes = $model->getChanges();
                $original = $model->getOriginal();
                Log::info('Original Values: ', $original);
                Log::info('Changes: ', $changes);

                // Check if changes are indeed being detected
                if (empty($changes)) {
                    //Log::warning('No changes detected for model ID: ' . $model->id);
                }
                if (!empty($changes)) {
                    // Check for changes in the `is_active` attribute
                    if (array_key_exists('is_active', $changes)) {
                        $oldIsActive = $original['is_active'] ?? null;
                        $newIsActive = $changes['is_active'];

                        if ($oldIsActive !== $newIsActive) {
                            // Log activation or deactivation
                            $event = $newIsActive ? 'activated' : 'deactivated';
                            $model->logEvent($event);
                        }
                    }

                    // Log other updates
                    $model->logEvent('updated');
                }
            }
        });

        // Log creation after the model is saved
        static::created(function ($model) {
            $model->logEvent('created');
        });

        // Log deletion after the model is deleted
        static::deleted(function ($model) {
            $model->logEvent('deleted');
        });
    }

    protected function logEvent($event)
    {
        // Ensure the model has an ID and exists
        if ($this->exists && $this->id !== null) {
            $family_data = $this->getFamilyId(get_class($this) , $this);
            AuditFamilies::create([
                'auditable_type' => get_class($this),
                'auditable_id' => $this->id,
                'family_id' => $family_data["family_id"],
                'family_type_cd' => $family_data["family_type_cd"],
                'done_by' => $this->updated_by,
                'relative_id' => $this->getRelativeId(get_class($this), $this),
                'event' => $event,
                'old_values' => json_encode($this->getOriginal()),
                'new_values' => json_encode($this->getChanges()),
                'changes' => json_encode(array_diff_assoc($this->getChanges(), $this->getOriginal())),
            ]);
        } else {
            Log::warning('Model ID is not set or model does not exist for event: ' . $event);
        }
    }

    protected  function getRelativeId($class , $obj ){
        switch($class){
            case get_class(new FamRelative()):
                return $obj->id;
            case get_class(new FamRelativeAttachment()):
            case get_class(new FamRelativeTalent()):
            case get_class(new FamRelativeEducation()):
            case get_class(new FamRelativeReports()):
            case get_class(new FamRelativeHealth()):
                return $obj->relative_id;
            default:
                return 0;
        }
    }
    protected  function getFamilyId($class , $obj){
        switch($class){

            case get_class(new FamMartyrData()):
                return ["family_id"=> $obj->id, "family_type_cd"=>1];
            case get_class(new FamWoundedData()):
                return ["family_id"=> $obj->id, "family_type_cd"=>2];
            case get_class(new FamPrisonerData()):
                return ["family_id"=> $obj->id, "family_type_cd"=>3];
            case get_class(new FamRelativeAttachment()):
            case get_class(new FamRelativeTalent()):
            case get_class(new FamRelativeEducation()):
            case get_class(new FamRelativeReports()):
            case get_class(new FamRelativeHealth()):
                $x=  FamRelative::find($obj->relative_id);
                return["family_id"=> $x->family_id, "family_type_cd"=>$x->family_type_cd];
            default:
                return ["family_id"=> $obj->family_id, "family_type_cd"=>$obj->family_type_cd];
        }
    }
}
