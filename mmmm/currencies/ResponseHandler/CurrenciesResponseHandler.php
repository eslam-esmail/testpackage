<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Currency;
use League\Fractal;

class CurrenciesResponseHandler extends Fractal\TransformerAbstract {

    public function transform(Currency $data) {
        $countries = [];
        foreach ($data->countries as $country){
            $countryName = \OlaHub\Helpers\CurrenciesHelper::returnCurrentLangField($country, 'name');
            $countries[$country->id] = [
                "id" => isset($country->id) ? $country->id : 0,
                "name" => $countryName,
            ];
        }
        $name = \OlaHub\Helpers\CurrenciesHelper::returnCurrentLangField($data, 'name');
        return [
            "id" => isset($data->id) ? $data->id : 0,
            "name" => $name,
            "currency_code" => isset($data->code) ? $data->code : FALSE,
            "created" => isset($data->created_at) ? \OlaHub\Helpers\CurrenciesHelper::convertStringToDate($data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\CurrenciesHelper::defineRowCreator($data),
            "last_update" => isset($data->updated_at) ? \OlaHub\Helpers\CurrenciesHelper::convertStringToDate($data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\CurrenciesHelper::defineRowUpdater($data),
            "countries_supported" => $countries,
        ];
    }

}
