<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{

    public function testGet()
    {
        $result = IP2ProxyLaravel::get('1.2.3.4');
        $this->assertEquals($result['isProxy'], '1');
    }

}
