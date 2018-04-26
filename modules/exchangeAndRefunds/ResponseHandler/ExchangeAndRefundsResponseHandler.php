<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ExchangeAndRefund;
use League\Fractal;

class ExchangeAndRefundsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;
    
    public function transform(ExchangeAndRefund $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountriesData();
        return $this->return; 
    }
    
    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->name) ? $this->data->name : "N/A",
            "allow_refund" => isset($this->data->allow_refund) ? $this->data->allow_refund : "N/A",
            "allow_exchange" => isset($this->data->allow_exchange) ? $this->data->allow_exchange : "N/A",
            "refund_days" => isset($this->data->refund_days) ? $this->data->refund_days : "N/A",
            "exchange_days" => isset($this->data->exchange_days) ? $this->data->exchange_days : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\ExchangeAndRefundsHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\ExchangeAndRefundsHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\ExchangeAndRefundsHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\ExchangeAndRefundsHelper::defineRowUpdater($this->data),
        ];
    }
    
    private function setCountriesData() {
        $countries = [];
        foreach ($this->data->country as $countryMain) {
            $countryName = \OlaHub\Helpers\ExchangeAndRefundsHelper::returnCurrentLangField($countryMain, 'name');
            $countries[$countryMain->id] = [
                "id" => isset($countryMain->id) ? $countryMain->id : 0,
                "name" => $countryName,
            ];
        }

        if (count($countries)) {
            $this->return["countries"] = $countries;
        }
    }

}
