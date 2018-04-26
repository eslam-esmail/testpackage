<?php

namespace OlaHub\Helpers;

abstract class OlaHubAdminHelper {

    static function timeStampToDate($time, $format = 'D d F, Y') {
        $return = $time;
        if ($time && $time > 0) {
            $return = date($format, $time);
        } else {
            $return = "N/A";
        }
        return $return;
    }

    static function convertStringToDate($string, $format = 'D d F, Y') {
        $return = $string;
        if ($string) {
            $time = strtotime($string);
            if ($time && $time > 0) {
                $return = date($format, $time);
            } else {
                $return = "N/A";
            }
        }
        return $return;
    }

    static function createSlugFromString($string, $delimiter = '-') {
        $return = $string;
        if ($string) {
            $return = str_replace(' ', '_', $string);
            $return = preg_replace("/[^|+-_a-zA-Z0-9\/]/", '', $return);
            $return = strtolower(trim($clean, '-'));
            $return = preg_replace("/[\/_|+ -]+/", $delimiter, $return);
        }

        return $return;
    }

    static function returnCurrentLangField($objectData, $fieldName) {
        $return = "N/A";
        $language = config('def_lang');
        if (isset($objectData->$fieldName)) {
            $jsonData = json_decode($objectData->$fieldName);
            if (isset($jsonData->$language) && !empty($jsonData->$language)) {
                $return = $jsonData->$language;
            } else {
                $return = $objectData->$fieldName;
            }
        }
        return $return;
    }

    static function defineRowCreator($data, $creatorColumn = 'created_by') {
        return isset($data->$creatorColumn) && $data->$creatorColumn > 0 ? $data->$creatorColumn : "N/A";
    }

    static function defineRowUpdater($data, $updaterColumn = 'updated_by') {
        return isset($data->$updaterColumn) && $data->$updaterColumn > 0 ? $data->$updaterColumn : "N/A";
    }

    static function setPasswordHashing($password) {
        $options = [
            'cost' => env('CRYPT_COST')
        ];
        $mdEncrypt = $password;
        for ($i = 0; $i <= env('CRYPT_COST'); $i++) {
            $mdEncrypt = md5($mdEncrypt);
        }
        $bEncrypt = password_hash($mdEncrypt, PASSWORD_BCRYPT, $options);
        $tempPassReplace = str_replace('$2y$' . env('CRYPT_COST') . '$', 'OlaHubHashing:', $bEncrypt);
        $tempPassEncoding = 'OlaHubHashing:' . base64_encode($tempPassReplace);
        return $tempPassEncoding;
    }

    static function matchPasswordHash($password, $hash) {
        $fullHashReplace = str_replace('OlaHubHashing:', '', $hash);
        $fullHashDecode = base64_decode($fullHashReplace);
        $fullHash = str_replace('OlaHubHashing:', '$2y$' . env('CRYPT_COST') . '$', $fullHashDecode);
        $FirstStepEncrypt = $password;
        for ($i = 0; $i <= env('CRYPT_COST'); $i++) {
            $FirstStepEncrypt = md5($FirstStepEncrypt);
        }
        return password_verify($FirstStepEncrypt, $fullHash);
    }

    public static function randomString($length = 8, $type = false) {
        if (env('APP_ENV') == 'local') {
                return '123456';
            }
        switch ($type) {
            case 'str':
                $seed = str_split('abdefghijkmnqrtyABDEFGHJKLMNQRTY');
                break;
            case 'str_num':
                $seed = str_split('abdefghijkmnqrtyABDEFGHJKLMNQRTY123456789');
                break;
            case 'num':
                $seed = str_split('1234567890');
                break;
            case 'spc':
                $seed = str_split('!@$%^&*');
                break;
            case 'num_spc':
                $seed = str_split('1234567890!@$%^&*');
                break;
            case 'str_spc':
                $seed = str_split('abdefghijkmnqrtyABDEFGHJKLMNQRTY!@$%^&*');
                break;
            default :
                $seed = str_split('abdefghijkmnqrtyABDEFGHJKLMNQRTY123456789!@$%^&*');
                break;
        }

        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, $length) as $k)
            $rand .= $seed[$k];
        return $rand;
    }

}
