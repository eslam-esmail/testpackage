<?php

namespace OlaHub\Models;

class ProductAttributeValue extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'catalog_attribute_values';

    protected $requestValidationRules = [

        //'product_attribute_id' => "required|numeric|exists:product_attributes,id",
        //'attribute_value' => "required|max:100",
    ];

    public function additionalQueriesFired() {
        $attrs = func_get_args();
    }


//    public function productAttribute(){
//        return $this->belongsTo('OlaHub\Models\ProductAttribute', 'product_attribute_id');
//    }


}
