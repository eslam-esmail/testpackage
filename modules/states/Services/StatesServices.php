<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\StatesRepository;

class StatesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new StatesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\StatesResponseHandler';
    }

}
