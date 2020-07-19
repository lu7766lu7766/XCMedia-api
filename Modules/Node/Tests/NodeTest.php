<?php

namespace Modules\Node\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Node\Entities\Node;
use Modules\Node\Service\ManageNodeService;
use Tests\TestCase;

class NodeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEdit()
    {
        \DB::enableQueryLog();
        // 相依物件
        // 待測物件
        $targetObj = ManageNodeService::getInstance();
        // 期望值
        $expected = Node::class;
        // 實際值
        $actual = $targetObj->edit('test', 'Test', 'test');
        var_dump($actual, \DB::getQueryLog());
        $this->assertInstanceOf($expected, $actual);
    }
}
