<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Courier;

class CouriersRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Courier)->newQuery();
        $this->mutation = new Courier;
    }

}
