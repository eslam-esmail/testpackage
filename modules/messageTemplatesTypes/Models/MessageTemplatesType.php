<?php

namespace OlaHub\Models;

class MessageTemplatesType extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'lkp_message_template_types';
    
    protected $requestValidationRules = [];
    
    public function additionalQueriesFired() {
        $attrs = func_get_args();
    }
}
