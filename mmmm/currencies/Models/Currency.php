<?php

namespace OlaHub\Models;

class Currency extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'lkp_currencies';
    
    protected $requestValidationRules = [
        'name' => "required|max:4000|json",
        'code' => "required|max:3"
    ];
    
    public function countries(){
        return $this->hasMany('OlaHub\Models\Country', 'currency_id');
    }
}
