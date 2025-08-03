<?php

namespace App\Traits;

trait HelperTrait
{

    public function getFamPermName($action , $module,$family_type_cd){
        $types[1]="mur";
        $types[2]="wounded";
        $types[3]="prisoner";
        return "fam_" . ($types[$family_type_cd] ?? "") . "_". $module ."_" . $action;
    }

    public function getChannelPermName($action , $module, $channel_cd)
    {
        $types[1] = "tyftv";
        $types[2] = "hayatv";
        $types[3] = "lebanontv";
        $types[4] = "hettynradio";
        $types[5] = "tyfradio";
        return "media_channel_" . $module . "_" . ($types[$channel_cd] ?? "") . "_" . $action;
    }

}
