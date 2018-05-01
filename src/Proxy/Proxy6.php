<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 19:56
 */

namespace ProxyAPI\Proxy;

use ProxyAPI\Exception\NoMoneyException;
use ProxyAPI\Exception\NotFoundException;
use ProxyAPI\Exception\ProxyNotAllowException;
use ProxyAPI\Exception\UnknownErrorException;
use ProxyAPI\Exception\WrongKeyException;
use ProxyAPI\Exception\WrongMethodException;
use ProxyAPI\Exception\WrongParamsException;
use ProxyAPI\Exception\WrongPriceException;
use ProxyAPI\Request\Request;
use ProxyAPI\Response\BuyResponse;
use ProxyAPI\Response\CheckResponse;
use ProxyAPI\Response\GetCountResponse;
use ProxyAPI\Response\GetPriceResponse;
use ProxyAPI\Response\ProxyListResponse;
use ProxyAPI\Response\Response;


/**
 * Class Proxy6
 * @package ProxyAPI
 */
class Proxy6 implements IProxy
{
    /** @var  string */
    private $api_key;

    /**
     * @param string $api_key
     * @return void
     */
    public function setApiKey(string $api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * @param int $count
     * @param int $period
     * @param int $version
     * @return GetPriceResponse
     */
    public function getPrice(int $count, int $period, $version = ProxyType::PROXY_TYPE_V4)
    {
        $params = [
            'count' => $count,
            'period' => $period,
            'version' => $version
        ];
        $response = new GetPriceResponse($this->makeRequest("/getprice/", $params));
        return $response;
    }

    /**
     * @param $country
     * @param int $version
     * @return GetCountResponse
     */
    public function getCount($country, $version = ProxyType::PROXY_TYPE_V4)
    {
        $params = [
            'country' => $country,
            'version' => $version
        ];
        $response = new GetCountResponse($this->makeRequest("/getcount/", $params));
        return $response;
    }

    /**
     * @param int $version
     * @return ProxyListResponse
     */
    public function getCountry($version = ProxyType::PROXY_TYPE_V4)
    {
        $params = [
            'version' => $version
        ];
        $response = new ProxyListResponse($this->makeRequest("/getcountry/", $params));
        return $response;
    }

    /**
     * @param string $state State returned proxies. Available values: active - Active, expired - Not active, expiring - Expiring, all - All (default);
     * @param string $description
     * @return ProxyListResponse
     */
    public function getProxy($state = ProxyState::ALL, $description = "")
    {
        $params = [
            'state' => $state,
            'descr' => $description
        ];
        $response = new ProxyListResponse($this->makeRequest("/getproxy/", $params));
        return $response;
    }

    /**
     * @param string $ids List of internal proxies
     * @param string $type Sets the type (protocol): http - HTTPS or socks - SOCKS5.
     * @return Response
     */
    public function setType($ids, $type)
    {
        $ids = $this->filterIds($ids);
        $params = [
            'ids' => $ids,
            'type' => $type,
        ];
        $response = new Response($this->makeRequest("/settype/", $params));
        return $response;
    }

    /**
     * @param $new
     * @param string $old
     * @param string $ids
     * @return Response
     */
    public function setDescription($new, $old = "", $ids = "")
    {
        $params = [
            'new' => $new,
            'old' => $old,
            'ids' => $ids,
        ];
        $response = new Response($this->makeRequest("/setdescr/", $params));
        return $response;
    }

    /**
     * @param $count
     * @param $period
     * @param $country
     * @param int $version Proxies version: 4 - IPv4, 3 - IPv4 Shared, 6 - IPv6 (default);
     * @param string $type Proxies type (protocol): socks or http (default);
     * @param string $description
     * @return BuyResponse
     */
    public function buy($count, $period, $country, $version = ProxyType::PROXY_TYPE_V4, $type = ProxyType::PROXY_PROTOCOL_HTTPS, $description = "")
    {
        $params = [
            'count' => $count,
            'period' => $period,
            'country' => $country,
            'version' => $version,
            'type' => $type,
            'descr' => $description,
        ];
        $response = new BuyResponse($this->makeRequest("/buy/", $params));
        return $response;
    }

    /**
     * @param int $period Extension period in days;
     * @param string $ids List of internal proxies’ numbers in our system, divided by comas.
     * @return BuyResponse
     */
    public function prolong($period, $ids)
    {
        $ids = $this->filterIds($ids);
        $params = [
            'period' => $period,
            'ids' => $ids,
        ];
        $response = new BuyResponse($this->makeRequest("/prolong/", $params));
        return $response;
    }

    /**
     * @param string $ids List of internal proxies’ numbers in our system, divided by comas;
     * @param string $description Technical comment you have entered when purchasing proxy or by method setdescr.
     * @return Response
     */
    public function delete($ids, $description = "")
    {
        $ids = $this->filterIds($ids);
        $params = [
            'ids' => $ids,
            'descr' => $description,
        ];
        $response = new Response($this->makeRequest("/delete/", $params));
        return $response;
    }

    /**
     * @param string $ids Internal proxy number in our system.
     * @return CheckResponse
     */
    public function check($ids)
    {
        $ids = $this->filterIds($ids);
        $params = [
            'ids' => $ids
        ];
        $response = new CheckResponse($this->makeRequest("/check/", $params));
        return $response;
    }

    /**
     * @param $url
     * @param $params
     * @return array
     */
    public function makeRequest($url, $params)
    {
        $params = array_filter($params);
        $request = new Request();
        $request->init($this->api_key . $url, $params);
        $response = $request->send();
        if (isset($response['error_id'])) {
            $error_id = (int)$response['error_id'];
            Proxy6::checkError($error_id);
        }
        return $response;
    }

    private function filterIds($ids)
    {
        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        return $ids;
    }

    public static function checkError($error_id)
    {
        switch ($error_id) {
            case 30:
                throw new UnknownErrorException("Unknown error.");
                break;
            case 100:
                throw new WrongKeyException("Authorization error, wrong key.");
                break;
            case 110:
                throw new WrongMethodException("Wrong method.");
                break;
            case 200:
                throw new WrongParamsException("Wrong proxies quantity, wrong amount or no quantity input.");
                break;
            case 210:
                throw new WrongParamsException("Period error, wrong period input (days) or no input.");
                break;
            case 220:
                throw new WrongParamsException("Country error, wrong country input (iso2 for country input) or no input.");
                break;
            case 230:
                throw new WrongParamsException("Error of the list of the proxy numbers. Proxy numbers have to divided with comas.");
                break;
            case 250:
                throw new WrongParamsException("Tech description error.");
                break;
            case 260:
                throw new WrongParamsException("Proxy type (protocol) error. Incorrect or missing.");
                break;
            case 300:
                throw new ProxyNotAllowException("Proxy amount error. Appears after attempt of purchase of more proxies than available on the service.");
                break;
            case 400:
                throw new NoMoneyException("Balance error. Zero or low balance on your account.");
                break;
            case 404:
                throw new NotFoundException("Element error. The requested item was not found.");
                break;
            case 410:
                throw new WrongPriceException("Error calculating the cost. The total cost is less than or equal to zero.");
                break;

            default:
                break;
        }
    }
}