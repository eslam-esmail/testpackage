<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class PaymentMethod extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    protected $table = 'payment_methods';
    protected $requestValidationRules = [];

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
        return $this->belongsToMany('OlaHub\Models\Country','country_payment_methods');
    }

}
