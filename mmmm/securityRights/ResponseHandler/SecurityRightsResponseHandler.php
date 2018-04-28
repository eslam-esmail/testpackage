<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\SecurityRight;
use League\Fractal;

class SecurityRightsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(SecurityRight $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setRoleData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->name) ? $this->data->name : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data)
        ];
    }

    private function setRoleData() {
        $roles = $this->data->role;
        $roleValue =[];

        foreach ($roles as $role)
        {
            $roleValue[$role->id] = [
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

}
