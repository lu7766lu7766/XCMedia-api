<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $a = json_decode(true, true);
        var_dump($a);
        $this->assertTrue($a);
    }
}
