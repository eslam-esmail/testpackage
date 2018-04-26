<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\ItemCategoriesRepository;

class ItemCategoriesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new ItemCategoriesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\ItemCategoriesResponseHandler';
        $this->filterValidator = [
            'parent_id' => "integer",
            'is_published' => "in:1,0",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

}
