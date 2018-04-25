<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 19:56
 */

namespace ProxyAPI\Proxy;


/**
 * Class Proxy6
 * @package ProxyAPI
 */
class Proxy6 implements IProxy
{

    /**
     * @param int $count
     * @param int $period
     * @param int $version
     * @return mixed
     */
    public function getPrice(int $count, int $period, $version = 4)
    {
        // TODO: Implement getPrice() method.
    }

    /**
     * @param $country
     * @param int $version
     * @return mixed
     */
    public function getCount($country, $version = 4)
    {
        // TODO: Implement getCount() method.
    }

    /**
     * @param int $version
     * @return mixed
     */
    public function getCountry($version = 4)
    {
        // TODO: Implement getCountry() method.
    }

    /**
     * @param string $state State returned proxies. Available values: active - Active, expired - Not active, expiring - Expiring, all - All (default);
     * @param string $description
     * @return mixed
     */
    public function getProxy($state = "", $description = "")
    {
        // TODO: Implement getProxy() method.
    }

    /**
     * @param string $ids List of internal proxies
     * @param string $type Sets the type (protocol): http - HTTPS or socks - SOCKS5.
     * @return mixed
     */
    public function setType($ids, $type)
    {
        // TODO: Implement setType() method.
    }

    /**
     * @param $new
     * @param string $old
     * @param string $ids
     * @return mixed
     */
    public function setDescription($new, $old = "", $ids = "")
    {
        // TODO: Implement setDescription() method.
    }

    /**
     * @param $count
     * @param $period
     * @param $country
     * @param int $version Proxies version: 4 - IPv4, 3 - IPv4 Shared, 6 - IPv6 (default);
     * @param string $type Proxies type (protocol): socks or http (default);
     * @param string $description
     * @return mixed
     */
    public function buy($count, $period, $country, $version = ProxyType::PROXY_TYPE_V4, $type = "", $description = "")
    {
        // TODO: Implement buy() method.
    }

    /**
     * @param int $period Extension period in days;
     * @param string $ids List of internal proxies’ numbers in our system, divided by comas.
     * @return mixed
     */
    public function prolong($period, $ids)
    {
        // TODO: Implement prolong() method.
    }

    /**
     * @param string $ids List of internal proxies’ numbers in our system, divided by comas;
     * @param string $description Technical comment you have entered when purchasing proxy or by method setdescr.
     * @return mixed
     */
    public function delete($ids, $description = "")
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param string $ids Internal proxy number in our system.
     * @return mixed
     */
    public function check($ids)
    {
        // TODO: Implement check() method.
    }
}