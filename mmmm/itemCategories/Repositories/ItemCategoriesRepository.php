<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\ItemCategory;

class ItemCategoriesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new ItemCategory)->newQuery();
        $this->mutation = new ItemCategory;
    }

}
