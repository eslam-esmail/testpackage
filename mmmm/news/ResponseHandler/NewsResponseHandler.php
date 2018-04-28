<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\News;
use League\Fractal;

class NewsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(News $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountriesData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id)? $this->data->id : 0,
            "title" => \OlaHub\Helpers\NewsHelper::returnCurrentLangField($this->data, 'title'),
            "description" => \OlaHub\Helpers\NewsHelper::returnCurrentLangField($this->data, 'description'),
            "global" => 0,
            "news_date" => array(
                "from" => isset($this->data->start_at)? \OlaHub\Helpers\NewsHelper::convertStringToDate($this->data->start_at) : "N/A",
                "to" => isset($this->data->end_at)? \OlaHub\Helpers\NewsHelper::convertStringToDate($this->data->end_at) : "N/A",
            ),
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\NewsHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\NewsHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\NewsHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\NewsHelper::defineRowUpdater($this->data),
        ];
    }

    private function setCountriesData() {
        $countries = [];
        foreach ($this->data->country as $countryMain) {
            $countryName = \OlaHub\Helpers\NewsHelper::returnCurrentLangField($countryMain, 'name');
            $countries[$countryMain->id] = [
                "id" => isset($countryMain->id) ? $countryMain->id : 0,
                "name" => $countryName,
                "status" => $countryMain->id,
            ];
            $this->return["publish"] = $countryMain->is_published;
        }
        
         $supportedCountries = \OlaHub\Models\Country::where('is_supported','1')->count();

        if (count($countries)) {
            $this->return["countries"] = $countries;
            if(count($countries) == $supportedCountries){
                $this->return["global"] = 1;
            }
        }
    }

}
