<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\LanguagesRepository;

class LanguagesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new LanguagesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\LanguagesResponseHandler';
    }

}
