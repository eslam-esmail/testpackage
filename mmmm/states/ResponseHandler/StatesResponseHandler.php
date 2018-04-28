<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\State;
use League\Fractal;

class StatesResponseHandler extends Fractal\TransformerAbstract {

    public function transform(State $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountryData();
        $this->setFranchiseData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => \OlaHub\Helpers\StatesHelper::returnCurrentLangField($this->data, 'name'),
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\StatesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\StatesHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\StatesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\StatesHelper::defineRowUpdater($this->data),
        ];
    }

    private function setCountryData() {
        $country = $this->data->country;
        if ($country) {
            $this->return["country"] = array(
                'id' => isset($country->id) ? $country->id : 0,
                'two_code' => isset($country->two_letter_iso_code) ? $country->two_letter_iso_code : "N/A",
                'three_code' => isset($country->three_letter_iso_code) ? $country->three_letter_iso_code : "N/A",
                'name' => \OlaHub\Helpers\StatesHelper::returnCurrentLangField($country, 'name'),
            );
        }

    }

    private function setFranchiseData() {
        $franchises = $this->data->franchise;
        $franchiseValue =[];

        foreach ($franchises as $franchise)
        {
            $franchiseValue[$franchise->id] = [
                'id' => isset($franchise->id) ? $franchise->id : 0,
                'full_name' =>array(
                    'first_name' => isset($franchise->first_name) ? $franchise->first_name : "N/A",
                    'last_name' => isset($franchise->last_name) ? $franchise->last_name : "N/A",
                )
            ];
        }

        if (count($franchiseValue)) {
            $this->return["franchise"] = $franchiseValue;
        }
    }

}
