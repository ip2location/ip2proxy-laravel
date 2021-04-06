<?php

namespace Ip2location\IP2ProxyLaravel;

class IP2ProxyLaravel
{
    private function load($mode)
    {
        if ($mode == 'bin')
        {
            $this->db = new \IP2Proxy\Database($this->getDatabasePath(), \IP2PROXY\Database::FILE_IO);
        } else if ($mode == 'ws')
        {
            $apikey = \Config::get('site_vars.IP2ProxyAPIKey');
            $package = (null !== \Config::get('site_vars.IP2ProxyPackage')) ? \Config::get('site_vars.IP2ProxyPackage') : 'PX1';
            $ssl = (null !== \Config::get('site_vars.IP2ProxyUsessl')) ? \Config::get('site_vars.IP2ProxyUsessl') : false;
            $this->ws = new \IP2Proxy\WebService($apikey, $package, $ssl);
        }
    }

    private function getDatabasePath()
    {
        return config('ip2proxylaravel.ip2proxy.local.path');
    }

    public function get($ip, $mode = 'bin')
    {
        $this->load($mode);
        if ($mode == 'bin')
        {
            $records = $this->db->lookup($ip, \IP2PROXY\Database::ALL);
        } else if ($mode == 'ws')
        {
            $records = $this->ws->lookup($ip);
        }
        return $records;
    }

}
