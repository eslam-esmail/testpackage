<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class SecurityRight extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'sec_rights';
    
    protected $requestValidationRules = [];

    public $manyToManyFilters = [

        'role_id' => 'role',

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
    }

    public function role() {
        return $this->belongsToMany('OlaHub\Models\SecurityRole','sec_role_rights','right_id','role_id');
    }
}
