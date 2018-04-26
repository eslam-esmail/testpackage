<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\ProductAttribute;

class ProductAttributesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new ProductAttribute)->newQuery();
        $this->mutation = new ProductAttribute;
    }

}
