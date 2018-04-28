<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ItemCategory;
use League\Fractal;

class ItemCategoriesResponseHandler extends Fractal\TransformerAbstract {

    
    private $return;
    private $data;

    public function transform(ItemCategory $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setCountriesData();
//        $this->setCategories();
        return $this->return;
    }
    private function setDefaultData() {
        $this->return = [
          "id" => isset($this->data->id) ? $this->data->id : 0,
          "name" => \OlaHub\Helpers\ItemCategoriesHelper::returnCurrentLangField($this->data, 'name'),
          "parent_id" => isset($this->data->parent_id) ? $this->data->parent_id : "N/A",
          "is_published" => isset($this->data->is_published) ? $this->data->is_published : 0,
          "created" => isset($this->data->created_at) ? \OlaHub\Helpers\ItemCategoriesHelper::convertStringToDate($this->data->created_at) : "N/A",
          "creator" => \OlaHub\Helpers\ItemCategoriesHelper::defineRowCreator($this->data),
          "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\ItemCategoriesHelper::convertStringToDate($this->data->updated_at) : "N/A",
          "updater" => \OlaHub\Helpers\ItemCategoriesHelper::defineRowUpdater($this->data),
      ];
    }
    
    private function setCountriesData() {
        $countries = [];
        foreach ($this->data->country as $countryMain) {
            $countryName = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($countryMain, 'name');
            $countries[$countryMain->id] = [
                "id" => isset($countryMain->id) ? $countryMain->id : 0,
                "name" => $countryName,
            ];
        }

        if (count($countries)) {
            $this->return["countries"] = $countries;
        }
    }
//
//    private function setCategories() {
//        $categories = [];
//        foreach ($this->data->itemCategory as $categoryMain) {
//            $categoryName = \OlaHub\Helpers\ItemCategoriesHelper::returnCurrentLangField($categoryMain, 'name');
//            $categories[$categoryMain->id] = [
//                "id" => isset($categoryMain->id) ? $categoryMain->id : 0,
//                "name" => $categoryName,
//            ];
//        }
//
//        if (count($categories)) {
//            $this->return["categories"] = $categories;
//        }
//    }

}
