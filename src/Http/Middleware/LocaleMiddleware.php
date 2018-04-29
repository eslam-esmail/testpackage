<?php

namespace OlaHub\Middlewares;

use Closure;
use OlaHub\Models\Country;
use OlaHub\Models\Language;

class LocaleMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $country = Country::where('two_letter_iso_code', env('DEFAULT_COUNTRY_CODE', 'JO'))->first();
        $defCountry = $country->id;
        $defLang = $country->language->default_locale;
        
        $languageCode = $request->headers->get('language');
        $countryCode = $request->headers->get('country');
        if ($countryCode) {
            $country = Country::where('two_letter_iso_code', $countryCode)->first();
            if ($country) {
                $defCountry = $country->id;
                if ($languageCode) {
                    $language = Language::where('default_locale', $languageCode)->first();
                    if ($language) {
                        $defLang = $language->default_locale;
                    } else {
                        $defLang = $country->language->default_locale;
                    }
                } else {
                    $defLang = $country->language->default_locale;
                }
            }
        }

        config(['def_lang' => $defLang]);
        config(['def_country' => $defCountry]);
        return $next($request);
    }

}
