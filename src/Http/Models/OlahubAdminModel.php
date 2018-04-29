<?php

namespace OlaHub\Models;

use Illuminate\Database\Eloquent\Model;

class OlahubAdminModel extends Model {

    protected $dates = ['deleted_at'];
    protected $guarded = array('created_at', 'updated_at', 'deleted_at', 'id');
    public $setLogUser = true;
    public $manyToManyFilters = [];

    public static function boot() {
        parent::boot();
    }

    public function getValidationsRules() {
        return $this->requestValidationRules;
    }

    public function getManyToManyFilters() {
        return $this->manyToManyFilters;
    }
    
    public function additionalQueriesFired(){
        
    }


}
