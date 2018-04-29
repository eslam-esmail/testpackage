<?php

namespace OlaHub\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
//use OlaHub\Models\OlahubAdminModel;

class BackageServiceProvider extends BaseServiceProvider
{
    
    public function boot(){
//        OlahubAdminModel::observe("OlaHub\\Observers\\OlaHubAdminObserve");
        echo 'here done';
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
