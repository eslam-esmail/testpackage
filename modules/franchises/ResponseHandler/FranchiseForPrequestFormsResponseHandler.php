<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Franchise;
use League\Fractal;

class FranchiseForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Franchise $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => isset($this->data->first_name) ? $this->data->first_name . ' ' . $this->data->last_name : "N/A",
        ];
    }
}
