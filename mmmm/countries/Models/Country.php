<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class Country extends OlahubAdminModel {

    protected $table = 'countries';
    protected $guarded = array('created_at', 'updated_at', 'deleted_at', 'id','name','two_letter_iso_code','three_letter_iso_code','language_id','currency_id');
    protected $requestValidationRules = [
        "name" => "olahub_unique:countries,name|json",
        'is_published' => "in:1,0",
        'is_supported' => "in:1,0",
    ];

    public $manyToManyFilters = [

        'policy_id' => 'exchangePloicy',

        'payment_method_id' => 'paymentMethod',

        'category_id' => 'category',

        'new_id' => 'news',

        'occasion_type_id' => 'occasion',


    ];

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    public static function boot() {
        parent::boot();
        static::deleted(function($model) {
            $model->countryExchangePloicy()->delete();
            $model->countryPaymentMethod()->delete();
            $model->states()->delete();
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

    private function saveOne($request, $model) {
        if($request->json('policy'))
        {
            $model->exchangePloicy()->sync($request->json('policy'));
        }
        if($request->json('method'))
        {
            $model->paymentMethod()->sync($request->json('method'));
        }
        if($request->json('category'))
        {
            $model->category()->sync($request->json('category'));
        }
        if($request->json('news'))
        {
            $model->news()->sync($request->json('news'));
        }
        if($request->json('occasion'))
        {
            $model->occasion()->sync($request->json('occasion'));
        }
    }


    private function saveMany($request, $models) {
        if($request->json('policy'))
        {
            foreach ($models as $model)
            {
                $model->exchangePloicy()->sync($request->json('policy'));
            }

        }
        if($request->json('method'))
        {
            foreach ($models as $model)
            {
                $model->paymentMethod()->sync($request->json('method'));
            }

        }
        if($request->json('category'))
        {
            foreach ($models as $model)
            {
                $model->category()->sync($request->json('category'));
            }

        }
        if($request['news'])
        {
            foreach ($models as $model)
            {
                $model->news()->sync($request['news']);
            }

        }
        if($request->json('occasion'))
        {
            foreach ($models as $model)
            {
                $model->occasion()->sync($request->json('occasion'));
            }

        }
    }


    public function currency() {
        return $this->belongsTo('OlaHub\Models\Currency', 'currency_id');
    }

    public function language() {
        return $this->belongsTo('OlaHub\Models\Language', 'language_id');
    }

    public function states() {
        return $this->hasMany('OlaHub\Models\State', 'country_id');
    }

    public function exchangePloicy() {
        return $this->belongsToMany('OlaHub\Models\ExchangeAndRefund','country_excng_refnd_plcy','country_id','policy_id');
    }

    public function paymentMethod() {
        return $this->belongsToMany('OlaHub\Models\PaymentMethod','country_payment_methods');
    }

    public function category() {
        return $this->belongsToMany('OlaHub\Models\ItemCategory','country_item_categories','country_id','category_id');
    }

    public function news() {
        return $this->belongsToMany('OlaHub\Models\News','country_news','country_id','new_id');
    }

    public function occasion() {
        return $this->belongsToMany('OlaHub\Models\Occasion','country_occasion_types','country_id','occasion_type_id');
    }

    public function merchantInvite() {
        return $this->hasMany('OlaHub\Models\MerchantInvite', 'country_id');
    }

}
