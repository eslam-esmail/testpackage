<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class State extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'states';
    
    protected $requestValidationRules = [
        'name' => "required|max:4000|json",
        'country_id' => "required|numeric|exists:countries,id",
    ];

    public $manyToManyFilters = [

        'franchise_id' => 'franchise',

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
        if($request->json('franchise'))
        {
            $model->franchise()->sync($request->json('franchise'));
        }

    }

    private function saveMany($request, $models)
    {
        if($request->json('franchise'))
        {
            foreach ($models as $model)
            {
                $model->franchise()->sync($request->json('franchise'));
            }

        }

    }
    
    public function country(){
        return $this->belongsTo('OlaHub\Models\Country', 'country_id');
    }

    public function franchise() {
        return $this->belongsToMany('OlaHub\Models\Franchise','franchise_states','state_id','franchise_id');
    }
}
