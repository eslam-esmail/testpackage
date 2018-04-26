<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\SecurityRightsRepository;

class SecurityRightsServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new SecurityRightsRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\SecurityRightsResponseHandler';
        $this->filterValidator = [
            'code' => "alpha|max:30",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

}
