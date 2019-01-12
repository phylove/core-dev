<?php

namespace App\Service;

use Phy\Core\CoreService;
use Phy\Core\DefaultService;
use Phy\Core\CoreException;
use Phy\Core\Models\ApiToken;

class SampleTest extends CoreService implements DefaultService {

    public $transaction = true;

    public function getDescription()
    {
        return "Sample";
    }

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        return $input;
    }

}