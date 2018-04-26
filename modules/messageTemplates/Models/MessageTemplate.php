<?php

namespace OlaHub\Models;

class MessageTemplate extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'message_templates';
    
    protected $requestValidationRules = [

//        'name' => "required|max:4000|json",
//        'code' => "required|max:30|olahub_unique:message_templates,code",
//        'subject' => "max:4000|json",
//        'body' => "max:4000|json",
//        'message_type' => "required|numeric|exists:message_templates,id",
//        'is_published' => "in:1,0",

    ];
    
    public function additionalQueriesFired() {
        $attrs = func_get_args();
    }

    public function messageTemplateType() {
        return $this->belongsTo('OlaHub\Models\MessageTemplatesType', 'message_type');
    }
}
