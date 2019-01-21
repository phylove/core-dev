<?php

if(!function_exists('service')){
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
    function service_exec($service, $input)
    {
        $object = service($service);
        return $object->execute($input);
    }
}