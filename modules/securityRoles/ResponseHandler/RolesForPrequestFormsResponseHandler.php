<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\SecurityRole;
use League\Fractal;

class RolesForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(SecurityRole $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->name) ? $this->data->name : "N/A",
        ];
    }
}
