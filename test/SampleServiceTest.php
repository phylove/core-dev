<?php

namespace Test;

use Tests\TestCase;

class SampleServiceTest extends TestCase
{
    /**
     * A sample unit test
     *
     * @return void
     */
    public function testBasicTest()
    {
        $service = service('sampleService');
        $output = $service->execute([]); 
        $this->assertEquals($output["test"], "version 1.4.0");
    }
}
