<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\SecurityRight;

class SecurityRightsRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new SecurityRight)->newQuery();
        $this->mutation = new SecurityRight;
    }

}
