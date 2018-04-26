<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Courier;
use League\Fractal;

class CouriersResponseHandler extends Fractal\TransformerAbstract {

    public function transform(Courier $data) {

          $country = $data->country;
          return [
              "id" => isset($data->id) ? $data->id : 0,
              "name" => \OlaHub\Helpers\CouriersHelper::returnCurrentLangField($data, 'name'),
              "API_Link" => isset($data->API_Link) ? $data->API_Link : "N/A",
              "address" => isset($data->address) ? $data->address : "N/A",
              "email" => isset($data->email) ? $data->email : "N/A",
              "phone_no" => isset($data->phone_no) ? $data->phone_no : "N/A",
              "mobile_no" => isset($data->mobile_no) ? $data->mobile_no : "N/A",
              "contact_name" => isset($data->contact_name) ? $data->contact_name : "N/A",
              "country" => array(
                  'id' => isset($country->id) ? $country->id : 0,
                  'code' => isset($country->two_letter_iso_code) ? $country->two_letter_iso_code : "N/A",
              ),
              "is_published" => isset($data->is_published) ? $data->is_published : 0,
              "created" => isset($data->created_at) ? \OlaHub\Helpers\CouriersHelper::convertStringToDate($data->created_at) : "N/A",
              "creator" => \OlaHub\Helpers\CouriersHelper::defineRowCreator($data),
              "last_update" => isset($data->updated_at) ? \OlaHub\Helpers\CouriersHelper::convertStringToDate($data->updated_at) : "N/A",
              "updater" => \OlaHub\Helpers\CouriersHelper::defineRowUpdater($data),
          ];
      }


}
