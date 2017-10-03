<?php

namespace Ip2location\IP2ProxyLaravel;

class IP2ProxyLaravel
{

    public function get($ip)
    {
        $db = new \IP2Proxy\Database()
        $db->open($this->getDatabasePath(), \IP2Proxy\Database::FILE_IO);

        $records = $db->getAll($ip);

        $db->close();

        return $records;
    }

    private function getDatabasePath()
    {
        return config('ip2proxylaravel.ip2proxy.local.path');
    }

}
