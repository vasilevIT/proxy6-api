<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 19:53
 */

namespace ProxyAPI\Proxy;
use ProxyAPI\Response\BuyResponse;
use ProxyAPI\Response\CheckResponse;
use ProxyAPI\Response\GetCountResponse;
use ProxyAPI\Response\GetPriceResponse;
use ProxyAPI\Response\ProxyListResponse;
use ProxyAPI\Response\Response;


/**
 * Interface IProxy
 * @package ProxyAPI
 */
interface IProxy
{

    /**
     * @param string $api_key
     * @return mixed
     */
    public function setApiKey(string $api_key);

    /**
     * @param int $count
     * @param int $period
     * @param int $version
     * @return GetPriceResponse
     */
    public function getPrice(int $count, int $period, $version = ProxyType::PROXY_TYPE_V4);

    /**
     * @param $country
     * @param int $version
     * @return GetCountResponse
     */
    public function getCount($country, $version = ProxyType::PROXY_TYPE_V4);

    /**
     * @param int $version
     * @return ProxyListResponse
     */
    public function getCountry($version = ProxyType::PROXY_TYPE_V4);

    /**
     * @param string $state State returned proxies. Available values: active - Active, expired - Not active, expiring - Expiring, all - All (default);
     * @param string $description
     * @return ProxyListResponse
     */
    public function getProxy($state = "", $description = "");

    /**
     * @param string $ids List of internal proxies
     * @param string $type Sets the type (protocol): http - HTTPS or socks - SOCKS5.
     * @return Response
     */
    public function setType($ids, $type);

    /**
     * @param $new
     * @param string $old
     * @param string $ids
     * @return Response
     */
    public function setDescription($new, $old = "", $ids = "");

    /**
     * @param $count
     * @param $period
     * @param $country
     * @param int $version Proxies version: 4 - IPv4, 3 - IPv4 Shared, 6 - IPv6 (default);
     * @param string $type Proxies type (protocol): socks or http (default);
     * @param string $description
     * @return BuyResponse
     */
    public function buy($count, $period, $country, $version = ProxyType::PROXY_TYPE_V4, $type = "", $description = "");

    /**
     * @param int $period Extension period in days;
     * @param string $ids List of internal proxies’ numbers in our system, divided by comas.
     * @return BuyResponse
     */
    public function prolong($period, $ids);

    /**
     * @param string $ids List of internal proxies’ numbers in our system, divided by comas;
     * @param string $description Technical comment you have entered when purchasing proxy or by method setdescr.
     * @return Response
     */
    public function delete($ids, $description = "");

    /**
     * @param string $ids Internal proxy number in our system.
     * @return CheckResponse
     */
    public function check($ids);

}