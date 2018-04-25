<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 19:53
 */

namespace ProxyAPI;


/**
 * Class ProxyAPI
 * @package ProxyAPI
 */
class ProxyAPIFactory
{

    /**
     * @param $type
     * @return null|IProxy
     */
    public function createProxyApi($type)
    {
        $api = null;
        switch ($type) {
            case "proxy6":
                $api = new Proxy6();
                break;
            default:
                break;
        }
        return $api;
    }

}