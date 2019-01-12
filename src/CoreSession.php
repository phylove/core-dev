<?php

namespace Phy\Core;

class CoreSession {

    public $sessions;

	public function setSession($sessions){
        $this->sessions = $sessions;
    }
    
    public function getSession($key){
        return $this->sessions->{$key};
	}

}