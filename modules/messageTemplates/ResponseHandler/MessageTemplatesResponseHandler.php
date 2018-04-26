<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\MessageTemplate;
use League\Fractal;

class MessageTemplatesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(MessageTemplate $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->name) ? $this->data->name : "N/A",
            "code" => isset($this->data->code) ? $this->data->code : "N/A",
            "subject" => isset($this->data->subject) ? $this->data->subject : "N/A",
            "body" => isset($this->data->body) ? $this->data->body : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\LanguagesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\OlaHubAdminHelper::defineRowCreator($this->data)
        ];
    }

}
