<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Group;
use League\Fractal;

class GroupsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Group $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setRoleData();
        $this->setFranchiseData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "code" => isset($this->data->code) ? $this->data->code : "N/A",
            "name" => isset($this->data->name) ? $this->data->name : "N/A", //\OlaHub\Helpers\GroupsHelper::returnCurrentLangField($this->data, 'name'),
            "description" => isset($this->data->description) ? $this->data->description : "N/A", //\OlaHub\Helpers\GroupsHelper::returnCurrentLangField($this->data, 'description'),
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\GroupsHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\GroupsHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\GroupsHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "userGroupUpdater" => \OlaHub\Helpers\GroupsHelper::defineRowUpdater($this->data)
        ];
    }

    private function setRoleData() {
        $roles = $this->data->role;
        $roleValue =[];

        foreach ($roles as $role)
        {
            $roleValue[] = [
                'id' => isset($role->id) ? $role->id : 0,
                "code" => isset($role->code) ? $role->code : "N/A",
                "name" => \OlaHub\Helpers\GroupsHelper::returnCurrentLangField($role, 'name'),
                "description" => \OlaHub\Helpers\GroupsHelper::returnCurrentLangField($role, 'description'),
            ];
        }

        if (count($roleValue)) {
            $this->return["role"] = $roleValue;
        }
    }

    private function setFranchiseData() {
        $franchises = $this->data->franchise;
        $franchiseValue =[];

        foreach ($franchises as $franchise)
        {

            $franchiseValue[] = [
                'id' => isset($franchise->id) ? $franchise->id : 0,
                "full_name" => isset($franchise->first_name) ? $franchise->first_name . ' ' . $franchise->last_name : "N/A",
                "first_name" => isset($franchise->first_name) ? $franchise->first_name : "N/A",
                "last_name" => isset($franchise->last_name) ? $franchise->last_name : "N/A",
            ];
        }

        if (count($franchiseValue)) {
            $this->return["franchise"] = $franchiseValue;
        }
    }

}
