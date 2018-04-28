<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\GroupsRepository;

class GroupsServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new GroupsRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\GroupsResponseHandler';
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

        $roleRepository = new \OlaHub\Repositories\SecurityRolesRepository;
        $franchiseRepository = new \OlaHub\Repositories\FranchisesRepository;
        $data = [];
        $roleData = $roleRepository->findAll($this->select, $this->trash);
        $data["allRoles"] = $this->handlingResponseCollection($roleData,'\OlaHub\ResponseHandlers\RolesForPrequestFormsResponseHandler');
        $franchiseData = $franchiseRepository->findAll($this->select, $this->trash);
        $data["allFranchise"] = $this->handlingResponseCollection($franchiseData,'\OlaHub\ResponseHandlers\FranchiseForPrequestFormsResponseHandler');
        return $data;
    }


}
