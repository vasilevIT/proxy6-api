<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 27/04/2018
 * Time: 17:54
 */

namespace ProxyAPI\Transport;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use ProxyAPI\Exception\ApiException;
use ProxyAPI\Exception\NoMoneyException;
use ProxyAPI\Exception\NotFoundException;
use ProxyAPI\Exception\ProxyNotAllowException;
use ProxyAPI\Exception\UnknownErrorException;
use ProxyAPI\Exception\WrongKeyException;
use ProxyAPI\Exception\WrongMethodException;
use ProxyAPI\Exception\WrongParamsException;
use ProxyAPI\Exception\WrongPriceException;

/**
 * Class GuzzleTransport
 * @package InstagramAmAPI\Transport
 */
class GuzzleTransport implements ITransport
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /** @var  Client */
    private $client;
    /** @var  Response */
    private $response;
    private $url;
    private $method;
    private $options;

    public function __construct()
    {
        $this->method = self::METHOD_GET;
        $this->options = [];
    }


    public function init()
    {
    }

    public function setProxy(string $proxy)
    {
        $this->options['proxy'] = $proxy;
    }

    public function setHeaders($headers)
    {
        $result_headers = [];
        foreach ($headers as $key => $value) {
            if (is_array($value)) {
                $full_value = [];
                foreach ($value as $key_inner => $value_inner) {
                    if (!empty($value_inner)) {
                        $full_value[] .= $key_inner . "=" . $value_inner . "; ";
                    }
                }
                $result_headers[$key] = $full_value;
            } else {
                if (!empty($value)) {
                    $result_headers[$key] = $value;
                }
            }
        }
        $this->options['headers'] = $result_headers;
    }

    public function setPost($flag = false)
    {
        if ($flag) {
            $this->method = self::METHOD_POST;
        }
    }

    public function setPostData($post_data)
    {
        $this->options['form_params'] = $post_data;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setTimeout($timeout = 15)
    {
        $this->options['timeout'] = $timeout;
    }

    public function close()
    {
    }

    public function getCookie()
    {
        $cookieJar = $this->client->getConfig('cookies');
        $cookiesJarArray = $cookieJar->toArray();
        $cookies = [];
        foreach ($cookiesJarArray as $cookie) {
            $cookies[$cookie['Name']] = $cookie['Value'];
        }
        return $cookies;
    }

    /**
     * @return bool|string
     * @throws ApiException
     */
    public function send()
    {
        try {
            $this->client = new Client(['cookies' => true]);
            $this->response = $this->client->request($this->method, $this->url, $this->options);
        } catch (RequestException $e) {
            $http_code = $e->getCode();
            $body = $e->getResponse()->getBody()->getContents();
            $body = json_decode($body, true);
            if (!is_null($body)) {
                if (isset($body['error_id']) && !empty($body['error_id'])) {
                    $error_id = (int)$body['error_id'];
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
            switch ($e->getCode()) {
                case 200:
//                ok
                    break;
                case 404:
                    throw new NotFoundException("NotFound.");
                default:
                    throw new ApiException("Http code: {$http_code}");
                    break;
            }
        }
        $body = $this->response->getBody()->getContents();
        return $body;
    }

    public function getRequestInfo()
    {
        return [
            'http_code' => $this->response->getStatusCode()
        ];
    }

    /**
     * Добавляет вложение (обычно файл) в тело запроса
     * @param $attachment
     */
    public function addAttachment($attachment)
    {
        $attachment = array_filter($attachment);
        if (!empty($attachment)) {
            $this->options['multipart'][] = $attachment;
        }
    }
}