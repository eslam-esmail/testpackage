<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\ProductAttributesRepository;

class ProductAttributesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new ProductAttributesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\ProductAttributesResponseHandler';
        $this->filterValidator = [
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

}
