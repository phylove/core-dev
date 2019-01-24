<?php

namespace Phy\Core;

use DB;
use Validator;
use Log;


abstract class CoreService implements DefaultService {

	static protected $instances = [];
	
	abstract protected function prepare($data);
	abstract protected function process($data, $originalData);

	static public function getInstance() {
        $class = get_called_class();
        if (! array_key_exists($class, self::$instances)) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }

	public function execute($data){
		$originalData = $data;
		$result = [];
		
		try {
            if($this->transaction !== null && $this->transaction !== false)
			    DB::beginTransaction();
			
			$validator = Validator::make($data, $this->rules());

			if ($validator->fails()) {
				throw new CoreException("", $validator->errors());
			}

			$dataProcess = is_null($this->prepare($data))? $originalData : $this->prepare($data);

			$result =  $this->process($dataProcess, $originalData);
			
			if($this->transaction !== null && $this->transaction !== false)
			    DB::commit();
		} catch(CoreException $ex){
			if($this->transaction !== null && $this->transaction !== false)
			    DB::rollback();
			throw $ex;
        } catch (\Exception $ex){
            $this->errorMessageValidation($ex->getMessage());
        }
        
		return $result;
	}

	protected function rules() {
		return [];
	}

	/**
	 * @param string $message error Message
	 * @throws Phy\Core\CoreException
	 */

	protected function errorMessageValidation($message="") {
		throw new CoreException($message);
	}


	/**
	 * @param string $errors 
	 * @throws Phy\Core\CoreException
	 */

	protected function errorListValidation($errors=[]) {
		throw new CoreException("", $errors);
	}
}