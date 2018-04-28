<?php

namespace OlaHub\Models;
use Illuminate\Http\Request;

class ProductAttribute extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'catalog_item_attributes';

    protected $requestValidationRules = [
        // 'name' => "required|max:4000|json",
        // 'description' => "max:4000|json",
    ];

    public function additionalQueriesFired() {
        $attrs = func_get_args();
        if (isset($attrs[0]) && isset($attrs[0]['model'])) {
            $request = Request::capture();
            if ($attrs[0]['count'] == 'one') {
                $this->saveOne($request, $attrs[0]['model']);
            } else {
                $this->saveMany($request, $attrs[0]['model']);
            }
        }
    }

    private function saveOne($request, $model)
    {
        if($request->json('attributeOptions'))
        {
            $attr_id = $model->id;
            $attrValues = $request->json('attributeOptions');
            foreach($attrValues as $oneVal){
                $newVal = new ProductAttributeValue;
                $newVal->product_attribute_id = $attr_id;
                $newVal->attribute_value = $oneVal;
                $newVal->save();
            }
        }
    }

    private function saveMany($request, $models)
    {
        if(isset($request->attributeOptions))
        {
            foreach ($models as $model)
            {
                $attr_id = $model->id;
                $attrValues = $request->attributeOptions;
                foreach($attrValues as $oneVal){
                    $newVal = new ProductAttributeValue;
                    $newVal->product_attribute_id = $attr_id;
                    $newVal->attribute_value = $oneVal;
                    $newVal->save();
                }
            }

        }
    }


    public function productAttributeValue() {
        return $this->hasMany('OlaHub\Models\ProductAttributeValue', 'product_attribute_id');
    }


}
