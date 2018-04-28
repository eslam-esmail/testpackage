<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class News extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'news';
    
    protected $requestValidationRules = [


//        'title' => "required|max:4000|json",
//        'description' => "required|max:4000|json",

//        'start_at' => "required|date_format:Y-m-d h:i:s|before:end_at",
//        'end_at' => "required|date_format:Y-m-d h:i:s|after:start_at",

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
        if($request['country'])
        {
            $model->country()->sync([6 => ["is_published"=>1]]);
        }
    }

    private function saveMany($request, $models) {
        if($request['country'])
        {
            foreach ($models as $model)
            {
                $model->country()->sync($request['country']);
            }

        }
    }


    public function country() {
        return $this->belongsToMany('OlaHub\Models\Country','country_news','new_id','country_id');
    }
}
