<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Language;
use League\Fractal;

class LanguagesResponseHandler extends Fractal\TransformerAbstract {

    public function transform(Language $data) {
        $countries = [];
        foreach ($data->countries as $country){
            $countryName = \OlaHub\Helpers\LanguagesHelper::returnCurrentLangField($country, 'name');
            $countries[$country->id] = [
                "id" => isset($country->id) ? $country->id : 0,
                "name" => $countryName,
            ];
        }
        $name = \OlaHub\Helpers\LanguagesHelper::returnCurrentLangField($data, 'name');
        return [
            "id" => isset($data->id) ? $data->id : 0,
            "lang_code" => isset($data->code) ? $data->code : FALSE,
            "name" => $name,
            "locale" => isset($data->default_locale) ? $data->default_locale : "N/A",
            "direction" => isset($data->direction) ? $data->direction : "N/A",
            "published" => isset($data->is_published) ? $data->is_published : 0,
            "created" => isset($data->created_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\LanguagesHelper::defineRowCreator($data),
            "last_update" => isset($data->updated_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\LanguagesHelper::defineRowUpdater($data),
            "countries_supported" => $countries,
        ];
    }

}
