<?php

namespace Phy\Core;

use Exception;

/**
 * Core Exception framework phy
 * @author Agung
 */

class CoreException extends Exception {

	/**
     * @var string error message
     */
	private $errorMessage;

	/**
     * @var array list of error
     */
	private $errorList;

	public function __construct($errorMessage = "", $errorList = []){
		$this->errorMessage = $errorMessage;
		$this->errorList = $errorList;
	}

	/**
	 * @return string $this->errorMessage
	 */
	public function getErrorMessage(){
		return $this->errorMessage;
	}

	/**
	 * @return array $this->errorList
	 */
	public function getErrorList(){
		return $this->errorList;
	}
}