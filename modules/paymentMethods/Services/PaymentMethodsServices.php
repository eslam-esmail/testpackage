<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\PaymentMethodsRepository;

class PaymentMethodsServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new PaymentMethodsRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\PaymentMethodsResponseHandler';
        $this->filterValidator = [
            'is_published' => "in:1,0",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

}
