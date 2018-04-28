<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\SecurityRole;

class SecurityRolesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new SecurityRole)->newQuery();
        $this->mutation = new SecurityRole;
    }

}
