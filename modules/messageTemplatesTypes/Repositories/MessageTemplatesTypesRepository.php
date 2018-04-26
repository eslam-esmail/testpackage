<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\MessageTemplatesType;

class MessageTemplatesTypesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new MessageTemplatesType)->newQuery();
        $this->mutation = new MessageTemplatesType;
    }

}
