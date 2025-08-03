<?php

namespace App\Http\Requests\Family\common\family;

use App\Traits\HelperTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFamFamilyDataRequest extends FormRequest
{
    use HelperTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows($this->getFamPermName("edit" ,"family" , $this->family_type_cd));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $familyId = $this->route('id'); // Get the post ID from the route
        return [
            "id"=>"required|numeric",
            "family_id"=>"required|numeric",
            "family_type_cd"=>"required|numeric",
            "family_file_inner_no"=>[
                "required",
                "numeric",
                Rule::unique('fam_families')->ignore($familyId)
                ],
            "family_file_outer_no"=>[
                "required",
                "numeric",
                Rule::unique('fam_families')->ignore($familyId)
            ],
            "city_id"=>"required|numeric",
            "address"=>"required",
            "phone"=>"required|numeric",
            "mobile"=>"required|numeric",
            "application_status_cd"=>"required|numeric",
            "family_file_status_cd"=>"required|numeric",
            "male_children_count"=>"required|numeric",
            "female_children_count"=>"required|numeric",
            "mother_name"=>"required",
            "mother_id_number"=>"required",
            "mother_nationality_cd"=>"required|numeric",
            "mother_birth_date"=>"required",
            "mother_education_level_cd"=>"required|numeric",
            "mother_education_specialization_cd"=>"required|numeric",
            "mother_last_education_date"=>"required",
            "mother_studying_status_cd"=>"required|numeric",
            "mother_employment_status_cd"=>"required|numeric",
            "religious_commitment_status_cd"=>"required|numeric",
            "praying_status_cd"=>"required|numeric",
            "religious_lessons_status_cd"=>"required|numeric",
            "economic_status_cd"=>"required|numeric",
            'organizational_affiliation_cd'=>"required|numeric",
            "organizational_territory_cd"=>"required|numeric",
            "sponsorship_start_date"=>"before:sponsorship_end_date",
        ];
    }
    public function attributes()
    {
        return [
            "family_file_inner_no"=>"رقم الملف الداخلي",
            "family_file_outer_no"=>"رقم الملف الخارجي",
            "phone"=>"الهاتف",
            "mobile"=>"الموبايل",
        ];
    }
}
