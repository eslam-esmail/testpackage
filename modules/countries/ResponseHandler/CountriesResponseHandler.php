<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\Country;
use League\Fractal;

class CountriesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(Country $data) {
        $this->data = $data;
        $this->setDefaultData();
        $this->setLanguageData();
        $this->setCurrencyData();
        $this->setPoliciesData();
        $this->setStatesData();
        $this->setPaymentMethodData();
        $this->setCategories();
        $this->setNewsData();
        $this->setOccasionData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "id" => isset($this->data->id) ? $this->data->id : 0,
            "name" => \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($this->data, 'name'),
            "two_code" => isset($this->data->two_letter_iso_code) ? $this->data->two_letter_iso_code : "N/A",
            "three_code" => isset($this->data->three_letter_iso_code) ? $this->data->three_letter_iso_code : "N/A",
            "publish_status" => isset($this->data->is_published) ? $this->data->is_published : 0,
            "support_status" => isset($this->data->is_supported) ? $this->data->is_supported : "N/A",
            "created" => isset($this->data->created_at) ? \OlaHub\Helpers\CountriesHelper::convertStringToDate($this->data->created_at) : "N/A",
            "creator" => \OlaHub\Helpers\CountriesHelper::defineRowCreator($this->data),
            "last_update" => isset($this->data->updated_at) ? \OlaHub\Helpers\CountriesHelper::convertStringToDate($this->data->updated_at) : "N/A",
            "updater" => \OlaHub\Helpers\CountriesHelper::defineRowUpdater($this->data),
        ];
    }

    private function setLanguageData() {
        $language = $this->data->language;
        if ($language) {
            $this->return["language"] = array(
                'id' => isset($language->id) ? $language->id : 0,
                'code' => isset($language->default_locale) ? $language->default_locale : "N/A",
                'name' => \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($language, 'name'),
            );
        }
    }

    private function setCurrencyData() {
        $currency = $this->data->currency;
        if ($currency) {
            $this->return["currency"] = array(
                'id' => isset($currency->id) ? $currency->id : 0,
                'code' => isset($currency->code) ? $currency->code : "N/A",
                'name' => \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($currency, 'name'),
            );
        }
    }

    private function setPoliciesData() {
        $policies = [];
        foreach ($this->data->exchangePloicy as $policyMain) {
            $policyName = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($policyMain, 'name');
            $policies[$policyMain->id] = [
                "id" => isset($policyMain->id) ? $policyMain->id : 0,
                "name" => $policyName,
            ];
        }

        if (count($policies)) {
            $this->return["policies"] = $policies;
        }
    }
    private function setPaymentMethodData() {
        $methods = [];
        foreach ($this->data->paymentMethod as $methodMain) {
            $methodName = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($methodMain, 'name');
            $methods[$methodMain->id] = [
                "id" => isset($methodMain->id) ? $methodMain->id : 0,
                "name" => $methodName,
            ];
        }

        if (count($methods)) {
            $this->return["payment_methods"] = $methods;
        }
    }
    
    private function setCategories() {
        $categories = [];
        foreach ($this->data->category as $categoryMain) {
            $categoryName = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($categoryMain, 'name');
            $categories[$categoryMain->id] = [
                "id" => isset($categoryMain->id) ? $categoryMain->id : 0,
                "name" => $categoryName,
            ];
        }

        if (count($categories)) {
            $this->return["categories"] = $categories;
        }
    }

    private function setStatesData() {
        $states = [];
        foreach ($this->data->states as $state) {
            $stateName = \OlaHub\Helpers\OlaHubAdminHelper::returnCurrentLangField($state, 'name');
            $states[$state->id] = [
                "id" => isset($state->id) ? $state->id : 0,
                "name" => $stateName,
            ];
        }
        if (count($states)) {
            $this->return["states"] = $states;
        }
    }

    private function setNewsData() {
        $news = [];
        foreach ($this->data->news as $new) {
            $newsTitle = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($new, 'title');
            $newsDescription = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($new, 'description');
            $news[$new->id] = [
                "id" => isset($new->id) ? $new->id : 0,
                "title" => $newsTitle,
                "description" => $newsDescription,
                "news_date" => array(
                    "from" => isset($new->start_at)? \OlaHub\Helpers\CountriesHelper::convertStringToDate($new->start_at) : "N/A",
                    "to" => isset($new->end_at)? \OlaHub\Helpers\CountriesHelper::convertStringToDate($new->end_at) : "N/A",
                ),
            ];
        }
        if (count($news)) {
            $this->return["news"] = $news;
        }
    }

    private function setOccasionData() {
        $occasions = [];
        foreach ($this->data->occasion as $occasion) {
            $occasionName = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($occasion, 'name');
            $occasionDescription = \OlaHub\Helpers\CountriesHelper::returnCurrentLangField($occasion, 'description');
            $occasions[$occasion->id] = [
                "id" => isset($occasion->id) ? $occasion->id : 0,
                "name" => $occasionName,
                "description" => $occasionDescription,
            ];
        }
        if (count($occasions)) {
            $this->return["occasion"] = $occasions;
        }
    }

}
