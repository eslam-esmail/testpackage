<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\DTemplatesRepository;

class DTemplatesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new DTemplatesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\DTemplatesResponseHandler';
    }

}
