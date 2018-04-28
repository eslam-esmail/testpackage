<?php

namespace OlaHub\Repositories;

use OlaHub\Repositories\OlaHubAdminRepository;
use OlaHub\Models\Language;

class LanguagesRepository extends OlaHubAdminRepository {

    public function __construct() {
        $this->query = (new Language)->newQuery();
        $this->mutation = new Language;
    }

}
