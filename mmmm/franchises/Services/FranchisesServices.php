<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\FranchisesRepository;

class FranchisesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new FranchisesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\FranchisesResponseHandler';
        $this->filterValidator = [
            'country_id' => "integer",
            'is_active' => "in:1,0",
            'is_first_login' => "in:1,0",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

    function secureLogin($headers) {
        $agent = $headers['user-agent'];
        $criteria['email'] = ["is" => $this->requestData['email']];
        $data = $this->repo->findOneBy($criteria);
        $password = $this->requestData['password'];
        if ($data) {
            if (\OlaHub\Helpers\FranchisesHelper::matchPasswordHash($password, $data->password)) {
                if ($data->is_active) {
                    $agentData = \OlaHub\Models\FranchiseSessions::checkAgent($data, $agent[0]);
                    return ['data' => $agentData];
                } else {
                    return ['error' => 500, 'msg' => 'No data found - Not active'];
                }
            } else {
                return ['error' => 500, 'msg' => 'Password not correct'];
            }
        } else {
            return ['error' => 204, 'msg' => 'E-Mail not correct'];
        }

        return ['error' => 500, 'msg' => 'Unkown error'];
    }

    public function getPrerequestFormData() {
        $groupRepository = new \OlaHub\Repositories\GroupsRepository;
        $roleRepository = new \OlaHub\Repositories\SecurityRolesRepository;
        $data = [];
        $groupData = $groupRepository->findAll($this->select, $this->trash);
        $data["allGroups"] = $this->handlingResponseCollection($groupData, '\OlaHub\ResponseHandlers\GroupsForPrequestFormsResponseHandler');
        $roleData = $roleRepository->findAll($this->select, $this->trash);
        $data["allRoles"] = $this->handlingResponseCollection($roleData, '\OlaHub\ResponseHandlers\RolesForPrequestFormsResponseHandler');
        return $data;
    }

}
