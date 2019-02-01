<?php



if(!function_exists('service')){

    /**
     * get service object
     * 
     * @param string     $service  service name in call
     * @return object    the result instance of Class Service
     */ 

    function service($service)
    {
        $classService = "App\\Service\\".ucfirst($service);
        if(!class_exists($classService)){
            throw New \Phy\Core\CoreException("Service doesn't exists");
            return null;
        }

        return $classService::getInstance();
    }
}

if(!function_exists('service_exec')){
    
    /**
     * execute service when service dont't call first
     * 
     * @param string     $service
     * @param array      $input input of service
     * @return mixed     the result of behavioure service
     */ 
    function service_exec($service, $input)
    {
        $object = service($service);
        $object->transaction = false;
        return $object->execute($input);
    }
}