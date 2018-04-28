<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Occasion;

class OccasionsRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Occasion)->newQuery();
        $this->mutation = new Occasion;
    }

}
