<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ProductAttribute;
use League\Fractal;

class ProductAttributesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(ProductAttribute $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setproductAttributeValueData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id)? $this->data->id : 0,
            "name" => \OlaHub\Helpers\ProductAttributesHelper::returnCurrentLangField($this->data, 'name'),
            "description" => \OlaHub\Helpers\ProductAttributesHelper::returnCurrentLangField($this->data, 'description'),
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\ProductAttributesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\ProductAttributesHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\ProductAttributesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\ProductAttributesHelper::defineRowUpdater($this->data),
        ];
    }

    private function setproductAttributeValueData() {
        $product_attribute_values = $this->data->productAttributeValue;
        $attribute_value =[];

        foreach ($product_attribute_values as $product_attribute_value)
        {
            $attribute_value[$product_attribute_value->id] = [
                'id' => isset($product_attribute_value->id) ? $product_attribute_value->id : 0,
                'value' => isset($product_attribute_value->attribute_value) ? $product_attribute_value->attribute_value : "N/A",
            ];
        }

        if (count($attribute_value)) {
            $this->return["attribute_value"] = $attribute_value;
        }
    }

}
