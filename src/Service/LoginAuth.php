<?php

namespace Phy\Core\Service;

use Phy\Core\Helpers\DateUtil;
use Phy\Core\CoreService;
use Phy\Core\DefaultService;
use Phy\Core\CoreException;
use Phy\Core\Models\User;
use Phy\Core\Models\ApiToken;

/**
 * Class of Login Authorize
 *
 * @author Agung
 */

class LoginAuth extends CoreService implements DefaultService {

    public $transaction = true;

    public function prepare($data)
    {
        
    }

    public function process($data, $originalData)
    {
        $user = User::where("username", $data["username"])->first();
        if(is_null($user)){
            throw New CoreException("User not found");
        }

        if(!password_verify($data["password"], $user->password)){
            throw New CoreException("User and Password don't match");
        }

        $key = sha1($user->id.microtime().rand(1000,999));

        $api = new ApiToken;
        $api->user_id = $user->id;
        $api->key = $key;
        $api->created_at = DATE_TIME_ACCESS;
        $api->updated_at = DATE_TIME_ACCESS;
        $api->save();

        $user->key = $key;

        return $user;

    }

}