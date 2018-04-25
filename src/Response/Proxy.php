<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 21:19
 */

namespace ProxyAPI\Response;


use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Proxy
 * @property string $id
 * @property string $ip
 * @property string $host
 * @property string $port
 * @property string $user
 * @property string $pass
 * @property string $type
 * @property string $country
 * @property string $date
 * @property string $date_end
 * @property string $descr
 * @property string $active
 * @package ProxyAPI\Response
 */
class Proxy extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'id' => 'string',
        'ip' => 'string',
        'host' => 'string',
        'port' => 'string',
        'user' => 'string',
        'pass' => 'string',
        'type' => 'string',
        'country' => 'string',
        'date' => 'string',
        'date_end' => 'string',
        'descr' => 'string',
        'active' => 'string',
    ];
}