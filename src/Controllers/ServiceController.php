<?php

namespace Phy\Core\Controllers;

use App\Http\Controllers\Controller;
use Phy\Core\CoreException;
use Phy\Core\CoreResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function service(Request $request)
    {
        try {
            $classService = "App\\Service\\".$request->get('service_name');
            if(!class_exists($classService)){
                throw New CoreException("Service doesn't exists");
            }

            $payload = $request->get('payload');
            $sessions = app()->make('sessions')->getSessionAll();
            $payload['session'] = $sessions;
            
            $object = new $classService();
            $result = $object->execute($payload);
            return CoreResponse::ok($result);

        } catch (CoreException $ex){
            return CoreResponse::fail($ex);
        }
    }

}