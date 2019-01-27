<?php

namespace Phy\Core;

use DB;
use Validator;
use Log;


abstract class CoreService implements DefaultService {
	abstract protected function prepare($input);
	abstract protected function process($input, $originalData);

	public function execute($input){
		$originalData = $input;
		$result = [];
		
		try {
            if($this->transaction !== null && $this->transaction !== false)
			    DB::beginTransaction();
			
			$validator = Validator::make($input, $this->rules());

			if ($validator->fails()) {
				throw new CoreException($validator->errors());
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