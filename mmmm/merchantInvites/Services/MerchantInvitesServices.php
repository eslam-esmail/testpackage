<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\MerchantInvitesRepository;

class MerchantInvitesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new MerchantInvitesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\MerchantInvitesResponseHandler';
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
