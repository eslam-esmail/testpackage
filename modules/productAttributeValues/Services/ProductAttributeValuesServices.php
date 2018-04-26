<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\ProductAttributeValuesRepository;

class ProductAttributeValuesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new ProductAttributeValuesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\ProductAttributeValuesResponseHandler';
    }

}
