<?php

namespace Phy\Core;

class CoreSession {

    private $sessions;

	private function setSession($sessions){
        $this->sessions = $sessions;
    }
    
    private function getSession($key){
        return $this->sessions->{$key};
	}

}