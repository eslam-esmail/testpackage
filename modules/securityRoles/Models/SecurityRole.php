<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class SecurityRole extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'sec_roles';
    
    protected $requestValidationRules = [
        'name' => "required|max:4000",
        'code' => "max:30",
        'description' => "max:4000",
    ];

    public $manyToManyFilters = [

        'group_id' => 'group',
        'franchise_id' => 'franchise',
        'right_id' => 'right',

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
        if($request->json('group'))
        {
            $model->group()->sync($request->json('group'));
        }

        if($request->json('franchise'))
        {
            $model->franchise()->sync($request->json('franchise'));
        }
        if($request->json('right'))
        {
            $model->right()->sync($request->json('right'));
        }
    }

    private function saveMany($request, $models)
    {
        if($request->json('group'))
        {
            foreach ($models as $model)
            {
                $model->group()->sync($request->json('group'));
            }

        }
        if($request->json('franchise'))
        {
            foreach ($models as $model)
            {
                $model->franchise()->sync($request->json('franchise'));
            }

        }
        if($request->json('right'))
        {
            foreach ($models as $model)
            {
                $model->right()->sync($request->json('right'));
            }

        }
    }




    public function group() {
        return $this->belongsToMany('OlaHub\Models\Group','sec_group_roles','role_id','group_id');
    }

    public function franchise() {
        return $this->belongsToMany('OlaHub\Models\Franchise','sec_franchise_roles','role_id','franchise_id');
    }

    public function right() {
        return $this->belongsToMany('OlaHub\Models\SecurityRight','sec_role_rights','role_id','right_id');
    }
}
