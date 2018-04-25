<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 21:14
 */

namespace ProxyAPI\Response;

/**
 * Class ProxyListResponse
 *
 * @property int $list_count
 * @property Proxy[] $list
 * @package ProxyAPI\Response
 */
class ProxyListResponse extends Response
{
    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user_id' => 'string',
        'balance' => 'string',
        'currency' => 'string',
        'list_count' => 'int',
        'list' => 'Proxy[]',
    ];
}