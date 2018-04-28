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

class MerchantInvitesController extends OlaHubAdminController {

    public function __construct(Request $request) {
        parent::__construct($request, 'OlaHub\Services\MerchantInvitesServices');
    }

    public function getPrerequestFormData()
    {
        $merchantInviteService = new \OlaHub\Services\MerchantInvitesServices();
        $return = $merchantInviteService->getPrerequestFormData();
        if (array_key_exists('error', $return)) {
            return response($return, $return['error']);
        }
        return response(json_encode($return), 200);
    }
}