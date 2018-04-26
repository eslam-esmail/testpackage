<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Country;

class CountriesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Country)->newQuery();
        $this->mutation = new Country;
    }

}
