<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\MerchantInvite;

class MerchantInvitesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new MerchantInvite)->newQuery();
        $this->mutation = new MerchantInvite;
    }

}
