<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Franchise;
use League\Fractal;

class FranchisesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Franchise $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setGroupData();
        $this->setRoleData();
        $this->setStateData();
        $this->setCountryData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "full_name" => isset($this->data->first_name) ? $this->data->first_name . ' ' . $this->data->last_name : "N/A",
            "first_name" => isset($this->data->first_name) ? $this->data->first_name : "N/A",
            "last_name" => isset($this->data->last_name) ? $this->data->last_name : "N/A",
            "username" => isset($this->data->username) ? $this->data->username : "N/A",
            "email" => isset($this->data->email) ? $this->data->email : "N/A",
            "status" => isset($this->data->is_active) ? $this->data->is_active : 0,
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data)
        ];
    }

    private function setCountryData() {
        $country = $this->data->country;
        if ($country) {
            $this->return["country"] = array(
                'id' => isset($country->id) ? $country->id : 0,
                'two_code' => isset($country->two_letter_iso_code) ? $country->two_letter_iso_code : "N/A",
                'name' => \OlaHub\Helpers\OlaHubAdminHelper::returnCurrentLangField($country, 'name'),
            );
        }
    }

    private function setGroupData() {
        $groups = $this->data->group;
        $groupValue = [];

        foreach ($groups as $group) {
            $groupValue[] = [
                'id' => isset($group->id) ? $group->id : 0,
                "code" => isset($role->code) ? $group->code : "N/A",
                "name" => \OlaHub\Helpers\FranchisesHelper::returnCurrentLangField($group, 'name'),
                "description" => \OlaHub\Helpers\FranchisesHelper::returnCurrentLangField($group, 'description'),
            ];
        }

        if (count($groupValue)) {
            $this->return["groups"] = $groupValue;
        }
    }
    
    private function setRoleData() {
        $groups = $this->data->role;
        $groupValue = [];

        foreach ($groups as $group) {
            $groupValue[] = [
                'id' => isset($group->id) ? $group->id : 0,
                "name" => isset($group->name) ? $group->name : "N/A",
                "code" => isset($group->code) ? $group->code : "N/A",
            ];
        }

        if (count($groupValue)) {
            $this->return["roles"] = $groupValue;
        }
    }

    private function setStateData() {
        $states = [];
        foreach ($this->data->state as $state) {
            $stateName = \OlaHub\Helpers\FranchisesHelper::returnCurrentLangField($state, 'name');
            $states[] = [
                "id" => isset($state->id) ? $state->id : 0,
                "name" => $stateName,
            ];
        }
        if (count($states)) {
            $this->return["states"] = $states;
        }
    }

}
