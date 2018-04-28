<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class ItemCategory extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    protected $table = 'catalog_item_categories';
    protected $requestValidationRules = [
//        'name' => "required|max:4000|json",
//        'parent_id' => "required|numeric|exists:catalog_item_categories,id",
        'is_published' => "in:1,0",

    ];

    public $manyToManyFilters = [

        'country_id' => 'country',
        'is_published' => 'country',

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

    private function saveOne($request, $model) {
        if($request->json('country'))
        {
            $model->country()->sync($request->json('country'));
        }
    }

    private function saveMany($request, $models) {
        if($request->json('country'))
        {
            foreach ($models as $model)
            {
                $model->country()->sync($request->json('country'));
            }

        }
    }


    public function country() {
        return $this->belongsToMany('OlaHub\Models\Country','country_item_categories','category_id','country_id');
    }

//    public function itemCategory() {
//        return $this->belongsToMany('OlaHub\Models\ItemCategory','catalog_item_categories','parent_id','id');
//    }

}
