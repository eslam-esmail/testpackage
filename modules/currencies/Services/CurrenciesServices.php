<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\CurrenciesRepository;

class CurrenciesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new CurrenciesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\CurrenciesResponseHandler';
    }

}
