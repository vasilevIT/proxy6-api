<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:40
 */

namespace ProxyAPI\Response;

/**
 * Class GetPriceResponse
 * @property float $price
 * @property float $price_single
 * @property int $period
 * @property int $count
 * @package ProxyAPI\Response
 */
class GetPriceResponse extends Response
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
    ];
}