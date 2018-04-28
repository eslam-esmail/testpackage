<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\OccasionsRepository;

class OccasionsServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new OccasionsRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\OccasionsResponseHandler';
        $this->filterValidator = [
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

}
