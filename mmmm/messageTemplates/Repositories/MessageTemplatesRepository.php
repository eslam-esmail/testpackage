<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\MessageTemplate;

class MessageTemplatesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new MessageTemplate)->newQuery();
        $this->mutation = new MessageTemplate;
    }

}
