<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Currency;

class CurrenciesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Currency)->newQuery();
        $this->mutation = new Currency;
    }

}
