<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:40
 */

namespace ProxyAPI\Response;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Response
 * @property string $status
 * @property string $user_id
 * @property string $balance
 * @property string $currency
 * @package ProxyAPI\Response
 */
class Response extends LazyJsonMapper
{
    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user_id' => 'string',
        'balance' => 'string',
        'currency' => 'string',
    ];
}