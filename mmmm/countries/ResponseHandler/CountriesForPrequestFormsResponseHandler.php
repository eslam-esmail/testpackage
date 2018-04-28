<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Country;
use League\Fractal;

class CountriesForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Country $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($this->data, 'name'),
        ];
    }

}
