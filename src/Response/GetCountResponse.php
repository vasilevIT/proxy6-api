<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 21:18
 */

namespace ProxyAPI\Response;

/**
 * Class GetCountResponse
 * @property int $count
 * @package ProxyAPI\Response
 */
class GetCountResponse extends Response
{
    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user_id' => 'string',
        'balance' => 'string',
        'currency' => 'string',
        'count' => 'int',
    ];
}