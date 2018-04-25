<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:00
 */

namespace ProxyAPI\Proxy;

/**
 * Class ProxyType
 * @package ProxyAPI
 */
class ProxyType
{
    const PROXY_TYPE_V4 = 4;
    const PROXY_TYPE_V4_SHARED = 3;
    const PROXY_TYPE_V6 = 6;

    const PROXY_PROTOCOL_HTTPS = 'https';
    const PROXY_PROTOCOL_SOCKS5 = 'socks';

}