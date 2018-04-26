<?php

namespace OlaHub\Models;

class FranchiseSessions extends OlahubAdminModel {

    //use \Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    protected $table = 'franchise_sessions';

    public static function boot() {
        parent::boot();
    }

    public function franchise() {
        return $this->belongsTo('OlaHub\Models\Franchise', 'franchise_id');
    }

    public static function checkAgent($franchise, $agent) {
        $return = [];
        $data = FranchiseSessions::where('franchise_id', $franchise->id)->where('farnchise_agent', $agent)->first();
        if ($data) {
            if ($data->status) {
                $code = \OlaHub\Helpers\FranchisesHelper::randomString(8, 'num');
                $agent = $agent;
                $id = $franchise->id;
                $token = \OlaHub\Helpers\FranchisesHelper::setPasswordHashing(serialize([
                            'agent' => $agent,
                            'id' => $id,
                            'code' => $code,
                ]));
                $data->hash_token = $token;
                $data->activation_code = $code;
                $data->save();
                return ['token' => $token];
            }
            $hashToken = '';
            $expire = strtotime("2 Hours");
            $franchiseID = $franchise->id;
            $code = \OlaHub\Helpers\FranchisesHelper::randomString(8, 'num');
            $array = serialize([
                'expire' => $expire,
                'number' => $franchiseID,
                'code' => $code,
            ]);
            $hashToken = base64_encode($array);
            $data->hash_token = $hashToken;
            $data->activation_code = $code;
            $data->save();
            return ['active' => $hashToken];
        }
        $code = \OlaHub\Helpers\FranchisesHelper::randomString(8, 'num');
        $agent = $agent;
        $id = $franchise->id;
        $token = \OlaHub\Helpers\FranchisesHelper::setPasswordHashing(serialize([
                    'agent' => $agent,
                    'id' => $id,
                    'code' => $code,
        ]));
        $session = new FranchiseSessions;
        $session->franchise_id = $franchise->id;
        $session->hash_token = $token;
        $session->activation_code = $code;
        $session->farnchise_agent = $agent;
        $session->status = '1';
        $session->save();
        return ['token' => $token];
        
//        
//        $session->activation_code = $token;
//        $session->save();
//        return ['new' => $code];
    }

}
