<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\ProductAttributeValue;

class ProductAttributeValuesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new ProductAttributeValue)->newQuery();
        $this->mutation = new ProductAttributeValue;
    }

}
