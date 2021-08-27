# IP2Proxy Laravel Extension
[![Latest Stable Version](https://img.shields.io/packagist/v/ip2location/ip2proxy-laravel.svg)](https://packagist.org/packages/ip2location/ip2proxy-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/ip2location/ip2proxy-laravel.svg?style=flat-square)](https://packagist.org/packages/ip2location/ip2proxy-laravel)

IP2Proxy Laravel extension enables the user to query an IP address if it was being used as open proxy, web proxy, VPN anonymizer and TOR exits.

*Note: This extension works in Laravel 6, Laravel 7 and Laravel 8.*


## INSTALLATION

1. Run the command: `composer require ip2location/ip2proxy-laravel` to download the package into the Laravel platform.
2. Edit `config/app.php` and add the below line in 'providers' section:  
`Ip2location\IP2ProxyLaravel\IP2ProxyLaravelServiceProvider::class,`
3. Then publish the config file by:  
`php artisan vendor:publish --provider='Ip2location\IP2ProxyLaravel\IP2ProxyLaravelServiceProvider' --force`

## USAGE

IP2Proxy Laravel extension is able to query the IP address proxy information from either BIN database or web service. This section will explain how to use this extension to query from BIN database and web service.

### BIN DATABASE

1. Download IP2Proxy BIN database
    - IP2Proxy free LITE database at https://lite.ip2location.com
    - IP2Proxy commercial database at https://www.ip2location.com/proxy-database
2. To use IP2Proxy databases, create a folder named as `ip2proxy` in the `database` directory.
3. Unzip and copy the BIN file into `database/ip2proxy/` folder. 
4. Rename the BIN file to IP2PROXY.BIN.
5. Create a **TestController** in Laravel using the below command line
```
php artisan make:controller TestController
```
6. Open the **app/Http/Controllers/TestController.php** in any text editor.
7. To use IP2Proxy databases, add the below lines into the controller file
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IP2ProxyLaravel;            //use IP2ProxyLaravel class

class TestController extends Controller
{
    //Create a lookup function for display
    public function lookup(){
        //Try query the geolocation information of 1.2.3.4 IP address
        $records = IP2ProxyLaravel::get('1.2.3.4', 'bin');

        echo '<p><strong>IP Address: </strong>' . $records['ipAddress'] . '</p>';
        echo '<p><strong>IP Number: </strong>' . $records['ipNumber'] . '</p>';
        echo '<p><strong>IP Version: </strong>' . $records['ipVersion'] . '</p>';
        echo '<p><strong>Country Code: </strong>' . $records['countryCode'] . '</p>';
        echo '<p><strong>Country: </strong>' . $records['countryName'] . '</p>';
        echo '<p><strong>State: </strong>' . $records['regionName'] . '</p>';
        echo '<p><strong>City: </strong>' . $records['cityName'] . '</p>';
        echo '<p><strong>Proxy Type: </strong>' . $records['proxyType'] . '</p>';
        echo '<p><strong>Is Proxy: </strong>' . $records['isProxy'] . '</p>';
        echo '<p><strong>ISP: </strong>' . $records['isp'] . '</p>';
        echo '<p><strong>Domain: </strong>' . $record['domain'] . '</p>';
        echo '<p><strong>Usage Type: </strong>' . $record['usageType'] . '</p>';
        echo '<p><strong>ASN: </strong>' . $record['asn'] . '</p>';
        echo '<p><strong>AS: </strong>' . $record['as'] . '</p>';
        echo '<p><strong>Last Seen: </strong>' . $record['lastSeen'] . '</p>';
        echo '<p><strong>Threat: </strong>' . $record['threat'] . '</p>';
        echo '<p><strong>Provider: </strong>' . $record['provider'] . '</p>';
    }
}
```
8. Add the following line into the *routes/web.php* file.
```
Route::get('test', 'TestController@lookup');
```
9. Enter the URL <your domain>/public/test and run. You should see the information of **1.2.3.4** IP address.

### WEB SERVICE

1. To use IP2Proxy Web Service, create a new file called "site_vars.php" in `config` directory.
2. In the site_vars.php, save the following contents:
```php
<?php
return [
    'IP2ProxyAPIKey' => 'your_api_key', // Required. Your IP2Proxy API key.
    'IP2ProxyPackage' => 'PX1', // Required. Choose the package you would like to use.
    'IP2ProxyUsessl' => false, // Optional. Use https or http.
];
```
3. Create a **TestController** in Laravel using the below command line
```
php artisan make:controller TestController
```
4. Open the **app/Http/Controllers/TestController.php** in any text editor.
5. To use IP2Proxy Web Service, add the below lines into the controller file.
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use IP2ProxyLaravel;            //use IP2ProxyLaravel class

class TestController extends Controller
{
    //Create a lookup function for display
    public function lookup(){
        //Try query the geolocation information of 1.2.3.4 IP address
        $records = IP2ProxyLaravel::get('1.2.3.4', 'ws');

        echo '<pre>';
        print_r($records);
        echo '</pre>';
    }
}

```
6. Add the following line into the *routes/web.php* file.
```
Route::get('test', 'TestController@lookup');
```
7. Enter the URL <your domain>/public/test and run. You should see the information of **1.2.3.4** IP address.

## DEPENDENCIES (IP2PROXY BIN DATA FILE)

This library requires IP2Proxy BIN data file to function. You may download the BIN data file at
* IP2Proxy LITE BIN Data (Free): https://lite.ip2location.com
* IP2Proxy Commercial BIN Data (Comprehensive): https://www.ip2location.com/proxy-database


## SUPPORT

Email: support@ip2location.com

Website: https://www.ip2location.com
