<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\SecurityRole;
use League\Fractal;

class SecurityRolesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(SecurityRole $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setGroupData();
        $this->setFranchiseData();
        $this->setRightData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->name) ? $this->data->name : "N/A",
            "code" => isset($this->data->code) ? $this->data->code : "N/A",
"description" => isset($this->data->description) ? $this->data->description : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data)
        ];
    }

    private function setGroupData() {
        $groups = $this->data->group;
        $groupValue =[];

        foreach ($groups as $group)
        {
            $groupValue[] = [
                'id' => isset($group->id) ? $group->id : 0,
                "code" => isset($group->code) ? $group->code : "N/A",
                "name" => \OlaHub\Helpers\SecurityRolesHelper::returnCurrentLangField($group, 'name'),
                "description" => \OlaHub\Helpers\SecurityRolesHelper::returnCurrentLangField($group, 'description'),
            ];
        }

        if (count($groupValue)) {
            $this->return["group"] = $groupValue;
        }
    }

    private function setFranchiseData() {
        $franchises = $this->data->franchise;
        $franchiseValue =[];

        foreach ($franchises as $franchise)
        {

            $franchiseValue[] = [
                'id' => isset($franchise->id) ? $franchise->id : 0,
                'full_name' => array(
                    'first_name' => isset($franchise->first_name) ? $franchise->first_name : "N/A",
                    'last_name' => isset($franchise->last_name) ? $franchise->last_name : "N/A",
                ),
            ];
        }

        if (count($franchiseValue)) {
            $this->return["franchise"] = $franchiseValue;
        }
    }

    private function setRightData() {
        $rights = $this->data->right;
        $rightValue =[];

        foreach ($rights as $right)
        {

            $rightValue[] = [
                'id' => isset($right->id) ? $right->id : 0,
                "code" => isset($right->code) ? $right->code : "N/A",
                "name" => \OlaHub\Helpers\SecurityRolesHelper::returnCurrentLangField($right, 'name'),
                "description" => \OlaHub\Helpers\SecurityRolesHelper::returnCurrentLangField($right, 'description'),
            ];
        }

        if (count($rightValue)) {
            $this->return["right"] = $rightValue;
        }
    }

}
