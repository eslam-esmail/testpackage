<?php

namespace OlaHub\Models;

class MerchantInvite extends OlahubAdminModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'merchant_invit';
    
    protected $requestValidationRules = [

        'supplier_name' => "required|max:240",
        'supplier_email' => "required|max:240|email",
        'status' => "required|max:20",
        'country_id' => "required|numeric|exists:countries,id",
        'subscribers' => "required|max:240|email",

    ];
    
    public function additionalQueriesFired() {
        $attrs = func_get_args();
    }

    public function country(){
        return $this->belongsTo('OlaHub\Models\Country', 'country_id');
    }
}
