<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 16:48
 */

namespace ProxyAPI\Transport;

use ProxyAPI\Exception\ApiException;

/**
 * Class CurlTransport
 * @package ProxyAPI\Transport
 */
class CurlTransport implements ITransport
{
    private $curl;
    private $url;

    public function __construct()
    {
    }

    /**
     * @param string $proxy
     */
    public function setProxy(string $proxy)
    {
        curl_setopt($this->curl, CURLOPT_PROXY, $proxy);
    }

    /**
     * Устанавливает заголовки
     * @param $headers
     */
    public function setHeaders($headers)
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Устанавливает тип запроса
     *
     * @param bool $flag
     */
    public function setPost($flag = false)
    {
        curl_setopt($this->curl, CURLOPT_POST, true);
    }

    /**
     * Устанавливает данные тела POST запроса
     * @param $post_data
     */
    public function setPostData($post_data)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
    }

    /**
     * Устанавливает url
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Устанавливает timeout соединения
     * @param int $timeout
     */
    public function setTimeout($timeout = 15)
    {
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $timeout);
    }

    /**
     * Закрывает соединение
     */
    public function close()
    {
        curl_close($this->curl);
    }

    /**
     * Возвращает массив cookie
     * @return mixed
     */
    public function getCookie()
    {
        return curl_getinfo($this->curl, CURLINFO_COOKIELIST);
    }

    /**
     * Выполняет запрос
     * @return mixed
     * @throws ApiException
     */
    public function send()
    {
        $response = curl_exec($this->curl);
        $http_code = curl_getinfo($this->curl)['http_code'];
        switch ($http_code) {
            case 200:
//                ok
                break;
            default:
                throw new ApiException("Http code: {$http_code}");
                break;

        }
        return $response;
    }

    public function init()
    {
        $this->curl = curl_init($this->url);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, "");
        $this->setTimeout(15);
    }

    /**
     * Возвращает данные о запросе
     * @return mixed
     */
    public function getRequestInfo()
    {
        return curl_getinfo($this->curl);
    }

    public function addAttachment($attachment)
    {
        // TODO: Implement addAttachment() method.
    }
}