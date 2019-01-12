<?php

namespace Phy\Core\Service;

use Phy\Core\Helpers\DateUtil;
use Phy\Core\CoreService;
use Phy\Core\DefaultService;
use Phy\Core\CoreException;
use Phy\Core\Models\User;
use Phy\Core\Models\ApiToken;

class LoginAuth extends CoreService implements DefaultService {

    public $transaction = true;

    public function getDescription()
    {
        return "Do Login";
    }

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        $user = User::where("username", $input["username"])->first();
        if(is_null($user)){
            throw New CoreException("User not found");
        }

        if(!password_verify($input["password"], $user->password)){
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