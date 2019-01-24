<?php

namespace Phy\Core\Service;

use Phy\Core\CoreService;
use Phy\Core\DefaultService;
use Phy\Core\CoreException;
use Phy\Core\Models\ApiToken;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

/**
 * Class of Logout App
 *
 * @author Agung
 */

class DoLogout extends CoreService implements DefaultService {

    public $transaction = true;

    public function prepare($data)
    {
        
    }

    public function process($data, $originalData)
    {
        $session = JWT::decode($data["token"], env('JWT_SECRET', 'xxx'), ['HS256']);

        ApiToken::where([
            "key" => $session->key,
            "user_id" => $session->user_id
        ])->delete();

        return [];

    }

}