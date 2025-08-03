<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditFamilies extends Model
{
    use HasFactory;

    protected $table="audits_families";
    protected $fillable=[
        'auditable_type' ,
        'auditable_id' ,
        'family_id' ,
        'family_type_cd' ,
        'relative_id' ,
        'event' ,
        'old_values' ,
        'new_values' ,
        'changes',
        'done_by'
    ];
    protected $appends=["module_name" , "event_name"];
    protected $with=["doer"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    function doer(){
        return $this->hasOne(User::class, "id" , "done_by");
    }
    function getModuleNameAttribute(){
        switch($this->auditable_type){
            case get_class(new FamPrisonerData()):
                return "البيانات الأساسية";
            case get_class(new FamMartyrData()):
                return "البيانات الأساسية";
            case get_class(new FamWoundedData()):
                return "البيانات الأساسية";

            case get_class(new FamFamily()):
                return "بياتا الأسرة";
            case get_class(new FamAttachment()):
                return "وثيقة";
            case get_class(new FamWoundedMedicalNeeds()):
                return "احتياج طبي";
            case get_class(new FamWoundedDisabilities()):
                return "اعاقة";
            case get_class(new FamWoundedPsychological()):
                return "اعاقة نفسية";
            case get_class(new FamAgent()):
                return "وكيل";
            case get_class(new FamSponsorship()):
                return "كفيل";
            case get_class(new FamHome()):
                return "المنزل";
            case get_class(new FamWar()):
                return "تضرر من الحرب";
            case get_class(new FamEducation()):
                return "تعليم";
            case get_class(new FamResearchNotes()):
                return "بحث اجتماعي";
            case get_class(new FamCommunications()):
                return "";
            case get_class(new FamVisit()):
                return "زيارة الأسرة";
            case get_class(new FamMoel()):
                return "بيانات معيل";
            case get_class(new FamRelativeAttachment()):
                return "وثيقة معال";
            case get_class(new FamRelativeTalent()):
                return "موهبة مهارة معال";
            case get_class(new FamRelativeEducation()):
                return "تعليم معال";
            case get_class(new FamRelativeReports()):
                return "تقرير اشرافي للمعال";
            case get_class(new FamRelativeHealth()):
                return "بيانات صحية للمعال";
                case get_class(new FamRelative()):
                return "بيانات  معال";
            default:
                return $this->auditable_type;
        }
    }
    function getEventNameAttribute(){
            switch($this->event){
                case "created":
                    return "اضافة";

                case "updated":
                    return "تعديل";

                case "deleted":
                    return "حذف";

                case "activated":
                    return "تفعيل";

                case "deactivated":
                    return "الغاء تفعيل";
                default:
                    return $this->event;

            }
    }
}
