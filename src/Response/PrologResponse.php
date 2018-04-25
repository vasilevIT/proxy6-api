<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:48
 */

namespace ProxyAPI\Response;


/**
 * Class PrologResponse
 * @property float $price
 * @property float $price_single
 * @property int $period
 * @property int $count
 * @property Proxy[] $list
 * @package ProxyAPI\Response
 */
class PrologResponse extends Response
{
    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user_id' => 'string',
        'balance' => 'string',
        'currency' => 'string',
        'price' => 'float',
        'price_single' => 'float',
        'period' => 'int',
        'count' => 'int',
        'list' => 'Proxy[]',
    ];
}