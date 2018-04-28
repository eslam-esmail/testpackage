<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\CountriesRepository;

class CountriesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new CountriesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\CountriesResponseHandler';
        $this->filterValidator = [
            'is_published' => "in:1,0",
            'is_supported' => "in:1,0",
            "id" => 'integer',
            "language_id" => 'integer',
            "currency_id" => 'integer',
            "two_letter_iso_code" => "alpha|max:2",
            "three_letter_iso_code" => "alpha|max:3",
        ];
    }

}
