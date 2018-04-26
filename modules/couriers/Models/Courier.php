<?php

namespace OlaHub\Models;

class Courier extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'couriers';

    protected $requestValidationRules = [
//        'country_id' => "required|numeric|exists:countries,id",
//        'name' => "required|max:4000|json",
//        'API_link' => "required|max:500",
//        'address' => "required|max:300",
//        'email' => "required|max:150",
//        'phone_no' => "required|numeric",
//        'mobile_no' => "required|numeric",
//        'contact_name' => "required|max:100",
//        'is_published' => "in:1,0",
    ];

    public function country(){
        return $this->belongsTo('OlaHub\Models\Country', 'country_id');
    }
}
