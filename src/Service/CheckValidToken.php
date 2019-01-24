<?php

namespace Phy\Core\Service;

use Phy\Core\DefaultService;
use Phy\Core\CoreService;
use Phy\Core\CoreException;
use Phy\Core\Models\ApiToken;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Exception;

/**
 * Class of Authorization JWT token
 *
 * @author Agung
 */

class CheckValidToken extends CoreService implements DefaultService {

    public $transaction = false;

    public function prepare($data)
    {

    }

    public function process($data, $originalData)
    {
        
        try {
            $payload = JWT::decode($data["token"], env('JWT_SECRET', 'xxx'), ['HS256']);
            $sessions = app()->make('sessions');
            
            $sessions->setSession($payload->session);
        } catch(ExpiredException $e) {
            throw New CoreException("Token is expired");
        } catch(Exception $e) {
           
            throw New CoreException("Invalid Token");
        }

        $checkApiValid = ApiToken::where([
            "key" => $payload->key,
            "user_id" => $payload->user_id
        ])->first();

        if(is_null($checkApiValid)) {
            throw New CoreException("Token is expired");
        }

        if($checkApiValid->updated_at < DATE_TIME_ACCESS-env('SESSION_LIFE_TIME', 6000)){
            $checkApiValid->delete();
            throw New CoreException("Token is expired");
        } else {
            $checkApiValid->updated_at = DATE_TIME_ACCESS;
            $checkApiValid->save();
        }

        return [];

    }

}