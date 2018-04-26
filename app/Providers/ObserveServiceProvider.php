<?php

namespace OlaHub\Providers;

use Illuminate\Support\ServiceProvider;
use OlaHub\Models;

class ObserveServiceProvider extends ServiceProvider
{

    public function boot(){
        Models\Language::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\Currency::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\Country::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\Courier::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\ExchangeAndRefund::observe("OlaHub\\Observers\\OlaHubAdminObserve");


        Models\Franchise::observe("OlaHub\\Observers\\OlaHubAdminObserve");

        Models\MessageTemplate::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\MessageTemplatesType::observe("OlaHub\\Observers\\OlaHubAdminObserve");

        Models\Group::observe("OlaHub\\Observers\\OlaHubAdminObserve");



        Models\News::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\ProductAttribute::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\ProductAttributeValue::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\Occasion::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\SecurityRole::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\MerchantInvite::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        Models\FranchiseSessions::observe("OlaHub\\Observers\\OlaHubAdminObserve");
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
