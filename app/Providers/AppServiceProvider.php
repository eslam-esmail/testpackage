<?php

namespace OlaHub\Providers;

use Illuminate\Support\ServiceProvider;
use OlaHub\Models\OlahubAdminModel;

class AppServiceProvider extends ServiceProvider
{
    
    public function boot(){
        OlahubAdminModel::observe("OlaHub\\Observers\\OlaHubAdminObserve");
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
