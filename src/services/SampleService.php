<?php

namespace App\Service;

use Phy\Core\CoreService;
use Phy\Core\CoreException;
use Phy\Core\Models\ApiToken;

class SampleService extends CoreService {

    public $transaction = true;

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        return ["test" => "version 1.4.0"];
    }

}