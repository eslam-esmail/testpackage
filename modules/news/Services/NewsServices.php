<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\NewsRepository;

class NewsServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        //$this->repo = new NewsRepository;
        $this->modelName = "\OlaHub\Models\News";
        $this->repo = new \OlaHub\Repositories\OlaHubAdminRepository($this->modelName);
        $this->responseHandler = '\OlaHub\ResponseHandlers\NewsResponseHandler';
        $this->filterValidator = [
            'start_at' => "date_format:Y-m-d h:i:s",
            'end_at' => "date_format:Y-m-d h:i:s",
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
