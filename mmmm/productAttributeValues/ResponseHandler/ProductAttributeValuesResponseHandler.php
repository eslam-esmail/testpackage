<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ProductAttributeValue;
use League\Fractal;

class ProductAttributeValuesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(ProductAttributeValue $data) {
        $this->data = $data;
        $this->setDefaultData();
//        $this->setproductAttributeData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "attribute_value" => isset($this->data->attribute_value) ? $this->data->attribute_value : "N/A",
//            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\ProductAttributeValuesHelper::convertStringToDate($this->data->created_at) : "N/A",
//            "creator" => \OlaHub\Helpers\ProductAttributeValuesHelper::defineRowCreator($this->data),
//            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\ProductAttributeValuesHelper::convertStringToDate($this->data->updated_at) : "N/A",
//            "updater" => \OlaHub\Helpers\ProductAttributeValuesHelper::defineRowUpdater($this->data)
        ];
    }


//    private function setproductAttributeData() {
//        $product_attribute = $this->data->productAttribute;
//        if ($product_attribute) {
//            $this->return["product_attribute"] = array(
//                'id' => isset($product_attribute->id) ? $product_attribute->id : 0,
//                'name' => \OlaHub\Helpers\ProductAttributeValuesHelper::returnCurrentLangField($product_attribute, 'name'),
//                'description' => \OlaHub\Helpers\ProductAttributeValuesHelper::returnCurrentLangField($product_attribute, 'description'),
//            );
//        }
//    }

}
