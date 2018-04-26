<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\ExchangeAndRefund;

class ExchangeAndRefundsRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new ExchangeAndRefund)->newQuery();
        $this->mutation = new ExchangeAndRefund;
    }

}
