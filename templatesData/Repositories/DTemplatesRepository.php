<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\DTemplate;

class DTemplatesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new DTemplate)->newQuery();
        $this->mutation = new DTemplate;
    }

}
