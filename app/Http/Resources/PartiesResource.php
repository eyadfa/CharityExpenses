<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "manager_name" => $this->manager_name,
            "mobile" => $this->mobile,
            "activity" => $this->activity->desc_ar??"",
            "status" => $this->status->desc_ar??"",
            "status_cd"=> $this->status_cd,
            "created_at"=> $this->created_at->format('Y-m-d'),
            "created_by"=>$this->created_by
        ];
    }
}
