<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\CouriersRepository;

class CouriersServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new CouriersRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\CouriersResponseHandler';
        $this->filterValidator = [
            'country_id' => "integer",
            'is_published' => "in:1,0",
            'email' => "email",
            'phone_no' => "integer",
            'mobile_no' => "integer",
            'contact_name' => "alpha",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

}
