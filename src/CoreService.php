<?php

namespace Phy\Core;

use DB;
use Validator;
use Log;


abstract class CoreService implements DefaultService {

	protected static $instances;

	abstract protected function prepare($input);
	abstract protected function process($input, $originalData);

	public static function getInstance() {
        $class = get_called_class();

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        return self::$instances[$class];
    }

	public function execute($input){
		$originalData = $input;
		$result = [];
		
		try {
            if($this->transaction !== null && $this->transaction !== false)
			    DB::beginTransaction();
			
			$validator = Validator::make($input, $this->rules());

			if ($validator->fails()) {
				throw new CoreException("", $validator->errors());
			}

			$this->prepare($input);
			$result =  $this->process($input, $originalData);
			
			if($this->transaction !== null && $this->transaction !== false)
			    DB::commit();
		} catch(CoreException $ex){
			if($this->transaction !== null && $this->transaction !== false)
			    DB::rollback();
			throw $ex;
        }	
        
		return $result;
	}

	protected function rules() {
		return [];
	}

	protected function errorBusinessValidation($message="", $errorList=[]) {
		throw new CoreException($message, $errorList);
	}
}