<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Franchise;

class FranchisesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Franchise)->newQuery();
        $this->mutation = new Franchise;
    }

}
