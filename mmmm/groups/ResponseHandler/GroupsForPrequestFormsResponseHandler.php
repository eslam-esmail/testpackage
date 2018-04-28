<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Group;
use League\Fractal;

class GroupsForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Group $data) {
        $this->data = $data;
        $this->setDefaultData();;
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => \OlaHub\Helpers\GroupsHelper::returnCurrentLangField($this->data, 'name'),
        ];
    }

}
