<?php

namespace OlaHub\Models;

class DTemplate extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'dtemplate';
    
    protected $requestValidationRules = [];
    
    public function additionalQueriesFired() {
        $attrs = func_get_args();
    }
}
