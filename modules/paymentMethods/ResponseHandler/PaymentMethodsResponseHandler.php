<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\PaymentMethod;
use League\Fractal;

class PaymentMethodsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(PaymentMethod $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountriesData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => \OlaHub\Helpers\PaymentMethodsHelper::returnCurrentLangField($this->data, 'name'),
            "api_link" => isset($this->data->api_link) ? $this->data->api_link : "N/A",
            "system_name" => \OlaHub\Helpers\PaymentMethodsHelper::returnCurrentLangField($this->data, 'system_name'),
            "logo" => isset($this->data->logo) ? $this->data->logo : "N/A",
            "publish_status" => isset($this->data->is_published) ? $this->data->is_published : 0,
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\PaymentMethodsHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\PaymentMethodsHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\PaymentMethodsHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\PaymentMethodsHelper::defineRowUpdater($this->data)
        ];
    }
    
    private function setCountriesData() {
        $countries = [];
        foreach ($this->data->country as $countryMain) {
            $countryName = \OlaHub\Helpers\PaymentMethodsHelper::returnCurrentLangField($countryMain, 'name');
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
