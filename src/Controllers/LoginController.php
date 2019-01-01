<?php

namespace Phy\Core\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Phy\Core\CoreException;
use Phy\Core\CoreResponse;
use App;
use Firebase\JWT\JWT;

class LoginController extends Controller
{
    function doLogin(Request $request)
    {

        try {
            $loginAuth = App::make('loginAuth');
            $result = $loginAuth->execute($request->all());
            $payload['user_id'] = $result->id;
            $payload['username'] = $result->username;
            $payload['key'] = $result->key;
            $payload['iat'] = time(); //waktu di buat
            $payload['exp'] = time() + 3600; //satu jam
            $output['token'] = JWT::encode($payload, env('JWT_SECRET', 'xxx'));

        } catch (CoreException $ex){
            return CoreResponse::fail($ex);
        }

        
        return CoreResponse::ok($output);
    }

    function doLogout(Request $request)
    {
        try {
            $doLogout = App::make('doLogout');
            $result = $doLogout->execute([
                "token" =>  $request->header('Authorization')
            ]);

        } catch (CoreException $ex){
            return CoreResponse::fail($ex);
        }

        return [
            "success" => true
        ];
    }
}
