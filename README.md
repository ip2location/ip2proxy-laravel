# IP2Proxy Laravel Extension
[![Latest Stable Version](https://img.shields.io/packagist/v/ip2location/ip2proxy-laravel.svg)](https://packagist.org/packages/ip2location/ip2proxy-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/ip2location/ip2proxy-laravel.svg?style=flat-square)](https://packagist.org/packages/ip2location/ip2proxy-laravel)

IP2Proxy Laravel extension enables the user to query an IP address if it was being used as open proxy, web proxy, VPN anonymizer and TOR exits.


## INSTALLATION

1. Run the command: `composer require ip2location/ip2proxy-laravel` to download the package into the Laravel platform.
2. Edit `config/app.php` and add the below line in 'providers' section:  
`Ip2location\IP2ProxyLaravel\IP2ProxyLaravelServiceProvider::class,`
3. Then publish the config file by:  
`php artisan vendor:publish --provider=Ip2location\IP2ProxyLaravel\IP2ProxyLaravelServiceProvider --force`
4. Download IP2Proxy BIN database
    - IP2Proxy free LITE database at https://lite.ip2location.com
    - IP2Proxy commercial database at https://www.ip2location.com/proxy-database
5. Create a folder named as `ip2proxy` in the `database` directory.
6. Unzip and copy the BIN file into `database/ip2proxy/` folder. 
7. Rename the BIN file to IP2PROXY.BIN.


## USAGE

In this tutorial, we will show you on how to create a **TestController** to display the IP information.

1. Create a **TestController** in Laravel using the below command line
```
php artisan make:controller TestController
```
2. Open the **app/Http/Controllers/TestController.php** in any text editor.
3. Add the below lines into the controller file.
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IP2ProxyLaravel;            //use IP2ProxyLaravel class

class TestController extends Controller
{
    //Create a lookup function for display
        public function lookup(){
        //Try query the geolocation information of 1.2.3.4 IP address
        $record = IP2ProxyLaravel::get('1.2.3.4');

        echo '<p><strong>IP Address: </strong>' . $record['ipAddress'] . '</p>';
        echo '<p><strong>IP Number: </strong>' . $record['ipNumber'] . '</p>';
        echo '<p><strong>IP Version: </strong>' . $record['ipVersion'] . '</p>';
        echo '<p><strong>Country Code: </strong>' . $record['countryCode'] . '</p>';
        echo '<p><strong>Country: </strong>' . $record['countryName'] . '</p>';
        echo '<p><strong>State: </strong>' . $record['regionName'] . '</p>';
        echo '<p><strong>City: </strong>' . $record['cityName'] . '</p>';
        echo '<p><strong>Proxy Type: </strong>' . $record['proxyType'] . '</p>';
        echo '<p><strong>Is Proxy: </strong>' . $record['isProxy'] . '</p>';
        echo '<p><strong>ISP: </strong>' . $record['isp'] . '</p>';
    }
}
```
4. Add the following line into the *routes/web.php* file.
```
Route::get('test', 'TestController@lookup');
```
5. Enter the URL <your domain>/public/test and run. You should see the information of **1.2.3.4** IP address.

## DEPENDENCIES (IP2PROXY BIN DATA FILE)

This library requires IP2Proxy BIN data file to function. You may download the BIN data file at
* IP2Proxy LITE BIN Data (Free): https://lite.ip2location.com
* IP2Proxy Commercial BIN Data (Comprehensive): https://www.ip2location.com/proxy-database


## SUPPORT

Email: support@ip2location.com

Website: https://www.ip2location.com
