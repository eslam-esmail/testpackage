<?php

namespace OlaHub\Providers;

use Illuminate\Support\ServiceProvider;
//use OlaHub\Models\OlahubAdminModel;

class BackageServiceProvider extends ServiceProvider
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
