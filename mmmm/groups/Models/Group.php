<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;
use OlaHub\Models\ManyToMany;

class Group extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'sec_groups';
    
    protected $requestValidationRules = [

        'code' => "required|max:30",
        'name' => "required|max:4000",
        'description' => "required|max:4000",

    ];

    public $manyToManyFilters = [

        'role_id' => 'role',
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
        if($request->json('role'))
        {
            $model->role()->sync($request->json('role'));
        }
        if($request->json('franchise'))
        {
            $model->franchise()->sync($request->json('franchise'));
        }
    }

    private function saveMany($request, $models)
    {
        if($request->json('role'))
        {
            foreach ($models as $model)
            {
                $model->role()->sync($request->json('role'));
            }

        }
        if($request->json('franchise'))
        {
            foreach ($models as $model)
            {
                $model->franchise()->sync($request->json('franchise'));
            }

        }
    }




    public function role() {
        return $this->belongsToMany('OlaHub\Models\SecurityRole','sec_group_roles','group_id','role_id');
    }

    public function franchise() {
        return $this->belongsToMany('OlaHub\Models\Franchise','sec_franchise_groups');
    }

}
