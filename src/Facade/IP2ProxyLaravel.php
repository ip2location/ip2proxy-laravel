<?php
namespace Ip2location\IP2ProxyLaravel\Facade;

use Illuminate\Support\Facades\Facade;

class IP2ProxyLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ip2proxylaravel';
    }
}
