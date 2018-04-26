<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\SecurityRolesRepository;

class SecurityRolesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new SecurityRolesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\SecurityRolesResponseHandler';
        $this->filterValidator = [
            'code' => "alpha|max:30",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

    public function getPrerequestFormData()
    {

        $groupRepository = new \OlaHub\Repositories\GroupsRepository;
        $franchiseRepository = new \OlaHub\Repositories\FranchisesRepository;
        $rightRepository = new \OlaHub\Repositories\SecurityRightsRepository;
        $data = [];
        $groupData = $groupRepository->findAll($this->select, $this->trash);
        $data["allGroups"] = $this->handlingResponseCollection($groupData,'\OlaHub\ResponseHandlers\GroupsForPrequestFormsResponseHandler');
        $franchiseData = $franchiseRepository->findAll($this->select, $this->trash);
        $data["allFranchise"] = $this->handlingResponseCollection($franchiseData,'\OlaHub\ResponseHandlers\FranchiseForPrequestFormsResponseHandler');
        $RightData = $rightRepository->findAll($this->select, $this->trash);
        $data["allRight"] = $this->handlingResponseCollection($RightData,'\OlaHub\ResponseHandlers\RightForPrequestFormsResponseHandler');
        return $data;
    }


}
