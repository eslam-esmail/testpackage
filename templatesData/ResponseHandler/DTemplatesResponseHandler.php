<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\DTemplate;
use League\Fractal;

class DTemplatesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(DTemplate $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->name) ? $this->data->name : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowUpdater($this->data)
        ];
    }

}
