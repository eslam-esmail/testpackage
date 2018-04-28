<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\State;

class StatesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new State)->newQuery();
        $this->mutation = new State;
    }

}
