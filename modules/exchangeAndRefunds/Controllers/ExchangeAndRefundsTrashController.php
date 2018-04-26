<?php

/**
 * Stores controller 
 * To do all operations for stores from admin side 
 * all functions return with response JSON encoded and headers
 * Header codes depending on https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
 * 
 * @author Mohamed EL-Absy <mohamed.elabsy@yahoo.com>
 * @copyright (c) 2018, OlaHub LLC
 * @version 1.0.0 
 */

namespace OlaHub\Controllers;

use Illuminate\Http\Request;

class ExchangeAndRefundsTrashController extends OlaHubAdminController {

    public function __construct(Request $request) {
        parent::__construct($request, 'OlaHub\Services\ExchangeAndRefundsServices');
        $this->service->trash = TRUE;
    }
    
    public function getString($string = false){
        if(is_string($string)){
            return $string;
        }
        return false;
    }
    
    

}
