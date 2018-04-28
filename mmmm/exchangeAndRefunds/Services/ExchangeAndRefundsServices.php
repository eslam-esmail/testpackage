<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\ExchangeAndRefundsRepository;

class ExchangeAndRefundsServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new ExchangeAndRefundsRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\ExchangeAndRefundsResponseHandler';
        $this->filterValidator = [
            'refund_days' => "integer",
            'exchange_days' => "integer",
            'allow_refund' => "in:1,0",
            'allow_exchange' => "in:1,0",
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }


    public function getPrerequestFormData()
    {

        $countryRepository = new \OlaHub\Repositories\CountriesRepository;
        $data = [];
        $countryData = $countryRepository->findAll($this->select, $this->trash);
        $data["allCountries"] = $this->handlingResponseCollection($countryData,'\OlaHub\ResponseHandlers\CountriesForPrequestFormsResponseHandler');
        return $data;
    }

}
