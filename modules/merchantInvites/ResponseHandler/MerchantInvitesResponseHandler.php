<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\MerchantInvite;
use League\Fractal;

class MerchantInvitesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(MerchantInvite $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountryData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "supplier_name" => isset($this->data->supplier_name) ? $this->data->supplier_name : "N/A",
            "supplier_email" => isset($this->data->supplier_email) ? $this->data->supplier_email : "N/A",
            "status" => isset($this->data->status) ? $this->data->status : "N/A",
            "expiry_time" => isset($this->data->expiry_time)? \OlaHub\Helpers\MerchantInvitesHelper::convertStringToDate($this->data->expiry_time) : "N/A",
            "subscribers" => isset($this->data->subscribers) ? $this->data->subscribers : "N/A",
            "reminder_at" => isset($this->data->reminder_at)? \OlaHub\Helpers\MerchantInvitesHelper::convertStringToDate($this->data->reminder_at) : "N/A",
            "reminder_count" => isset($this->data->reminder_count) ? $this->data->reminder_count : "N/A",
            "final_rem_at" => isset($this->data->final_rem_at)? \OlaHub\Helpers\MerchantInvitesHelper::convertStringToDate($this->data->final_rem_at) : "N/A",
            "need_by_date" => isset($this->data->need_by_date)? \OlaHub\Helpers\MerchantInvitesHelper::convertStringToDate($this->data->need_by_date) : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\MerchantInvitesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\MerchantInvitesHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\MerchantInvitesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\MerchantInvitesHelper::defineRowUpdater($this->data)
        ];
    }

    private function setCountryData() {
        $country = $this->data->country;
        if ($country) {
            $this->return["country"] = array(
                'id' => isset($country->id) ? $country->id : 0,
                'two_code' => isset($country->two_letter_iso_code) ? $country->two_letter_iso_code : "N/A",
                'three_code' => isset($country->three_letter_iso_code) ? $country->three_letter_iso_code : "N/A",
                'name' => \OlaHub\Helpers\MerchantInvitesHelper::returnCurrentLangField($country, 'name'),
            );
        }

    }

}
