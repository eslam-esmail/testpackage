<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Occasion;
use League\Fractal;

class OccasionsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Occasion $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountriesData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id)? $this->data->id : 0,
            "name" => \OlaHub\Helpers\OccasionsHelper::returnCurrentLangField($this->data, 'name'),
            "description" => \OlaHub\Helpers\OccasionsHelper::returnCurrentLangField($this->data, 'description'),
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\OccasionsHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\OccasionsHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\OccasionsHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\OccasionsHelper::defineRowUpdater($this->data),
        ];
    }

    private function setCountriesData() {
        $countries = [];
        foreach ($this->data->country as $countryMain) {
            $countryName = \OlaHub\Helpers\OccasionsHelper::returnCurrentLangField($countryMain, 'name');
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
