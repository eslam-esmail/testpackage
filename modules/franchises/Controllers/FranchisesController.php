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

class FranchisesController extends OlaHubAdminController {

    public function __construct(Request $request) {
        parent::__construct($request, 'OlaHub\Services\FranchisesServices');
    }
    
    function franchiseSecureLogin(Request $request){
        $return = $this->service->secureLogin($request->header());
        if (array_key_exists('error', $return)) {
            return response($return, $return['error']);
        }
        return response($return, 200);
    }

    public function getPrerequestFormData()
    {
        $franchiseService = new \OlaHub\Services\FranchisesServices;
        $return = $franchiseService->getPrerequestFormData();
        if (array_key_exists('error', $return)) {
            return response($return, $return['error']);
        }
        return response(json_encode($return), 200);
    }

}
