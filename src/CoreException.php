<?php

namespace Phy\Core;

use Exception;

class CoreException extends Exception {

	private $errorMessage;
	private $errorList;

	public function __construct($errorMessage = "", $errorList = []){
		$this->errorMessage = $errorMessage;
		$this->errorList = $errorList;
	}

	public function getErrorMessage(){
		return $this->errorMessage;
	}

	public function getErrorList(){
		return $this->errorList;
	}
}