<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Group;

class GroupsRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Group)->newQuery();
        $this->mutation = new Group;
    }

}
