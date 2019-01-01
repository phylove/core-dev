<?php

namespace App\Service;

use Phy\Core\DefaultService;
use Phy\Core\CoreService;
use Phy\Core\CoreException;
use Phy\Core\Models\ApiToken;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Exception;

class CheckValidToken extends CoreService implements DefaultService {

    public $transaction = false;

    public function getDescription()
    {
        return "Check Valid Token";
    }

    public function prepare($input)
    {
    }

    public function process($input, $originalInput)
    {
        
        try {
            $session = JWT::decode($input["token"], env('JWT_SECRET', 'xxx'), ['HS256']);
        } catch(ExpiredException $e) {
            throw New CoreException("Token is expired");
        } catch(Exception $e) {
            throw New CoreException("Invalid Token");
        }

        $checkApiValid = ApiToken::where([
            "key" => $session->key,
            "user_id" => $session->user_id
        ])->first();

        if(is_null($checkApiValid)) {
            throw New CoreException("Token is expired");
        }

        return [];

    }

}