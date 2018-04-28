<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class Franchise extends OlahubAdminModel {

    //use \Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'sec_franchise';
    
    protected $requestValidationRules = [
//        'first_name' => "required|max:255",
//        'last_name' => "required|max:255",
//        'email' => "required|email|max:255",
//        'username' => "required|max:255",
//        'country_id' => "required|numeric|exists:countries,id",
//        'is_active' => "in:1,0",
    ];

    public $manyToManyFilters = [

        'group_id' => 'group',
        'role_id' => 'role',
        'state_id' => 'state',

    ];
    
    public static function boot() {
        parent::boot();
        
        static::creating(function ($model){
            $randomPassword = \OlaHub\Helpers\OlaHubAdminHelper::randomString();
            $model->password = $randomPassword;
            $email = new \OlaHub\Libraries\SendEmails;
            //$email->sendEmailFunction();
        });
    }
    
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
        if($request->json('role'))
        {
            $model->role()->sync($request->json('role'));
        }
        if($request->json('state'))
        {
            $model->state()->sync($request->json('state'));
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
        if($request->json('role'))
        {
            foreach ($models as $model)
            {
                $model->role()->sync($request->json('role'));
            }

        }
        if($request->json('state'))
        {
            foreach ($models as $model)
            {
                $model->state()->sync($request->json('state'));
            }

        }
    }



    public function group() {
        return $this->belongsToMany('OlaHub\Models\Group','sec_franchise_groups');
    }

    public function country() {
        return $this->belongsTo('OlaHub\Models\Country','country_id');
    }

    public function role() {
        return $this->belongsToMany('OlaHub\Models\SecurityRole','sec_franchise_roles','franchise_id','role_id');
    }

    public function state() {
        return $this->belongsToMany('OlaHub\Models\State','franchise_states','franchise_id','state_id');
    }
}
