<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\PaymentMethod;

class PaymentMethodsRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new PaymentMethod)->newQuery();
        $this->mutation = new PaymentMethod;
    }

}
