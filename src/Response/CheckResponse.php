<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:46
 */

namespace ProxyAPI\Response;

/**
 * Class CheckResponse
 * @property int $proxy_id
 * @property bool $proxy_status
 * @package ProxyAPI\Response
 */
class CheckResponse extends Response
{
    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user_id' => 'string',
        'balance' => 'string',
        'currency' => 'string',
        'proxy_id' => 'int',
        'proxy_status' => 'bool',
    ];
}