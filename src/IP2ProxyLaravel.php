<?php

namespace Ip2location\IP2ProxyLaravel;

class IP2ProxyLaravel
{
    private $db;
    private $ws;
	
    private function load($mode)
    {
        if ($mode == 'bin')
        {
            $this->db = new \IP2Proxy\Database($this->getDatabasePath(), \IP2PROXY\Database::FILE_IO);
        } else if ($mode == 'ws')
        {
			if (!config()->has('site_vars.IP2LocationioAPIKey'))
			{
				$apikey = \Config::get('site_vars.IP2ProxyAPIKey');
				$package = (null !== \Config::get('site_vars.IP2ProxyPackage')) ? \Config::get('site_vars.IP2ProxyPackage') : 'PX1';
				$ssl = (null !== \Config::get('site_vars.IP2ProxyUsessl')) ? \Config::get('site_vars.IP2ProxyUsessl') : false;
				$this->ws = new \IP2Proxy\WebService($apikey, $package, $ssl);
			}
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
			if (config()->has('site_vars.IP2LocationioAPIKey'))
			{
				// Use IP2Location.io API
				$ioapi_baseurl = 'https://api.ip2location.io/?';
				$params = [
					'key'     => \Config::get('site_vars.IP2LocationioAPIKey'),
					'ip'      => $ip,
					'lang'    => ((config()->has('site_vars.IP2LocationioLanguage')) ? \Config::get('site_vars.IP2LocationioLanguage') : ''),
					'source'  => 'laravel-ipx',
				];
				// Remove parameters without values
				$params = array_filter($params);
				$url = $ioapi_baseurl . http_build_query($params);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FAILONERROR, 0);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);

				$response = curl_exec($ch);

				if (!curl_errno($ch))
				{
					if (($data = json_decode($response, true)) === null)
					{
						return false;
					}
					if (array_key_exists('error', $data))
					{
						throw new \Exception(__CLASS__ . ': ' . $data['error']['error_message'], $data['error']['error_code']);
					}
					return $data;
				}

				curl_close($ch);

				return false;
				
			} else
			{
				$records = $this->ws->lookup($ip);
			}
        }
        return $records;
    }

}
