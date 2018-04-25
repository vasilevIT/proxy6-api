<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 21:28
 */

namespace ProxyAPI\Response;

/**
 * Class GetCountryResponse
 * @package ProxyAPI\Response
 */
class GetCountryResponse extends Response
{
    const JSON_PROPERTY_MAP = [
        'status' => 'string',
        'user_id' => 'string',
        'balance' => 'string',
        'currency' => 'string',
        'list' => 'string[]',
    ];

}