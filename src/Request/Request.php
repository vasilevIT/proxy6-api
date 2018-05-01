<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:30
 */

namespace ProxyAPI\Request;

use ProxyAPI\Transport\CurlTransport;
use ProxyAPI\Transport\GuzzleTransport;
use ProxyAPI\Transport\ITransport;


/**
 * Class Request
 * @package ProxyAPI\Request
 */
class Request
{
    /** @var string  */
    protected $base_url = "https://proxy6.net/api/";

    /** @var  ITransport */
    protected $transport;
    /** @var array */
    protected $data;
    /** @var array */
    private $headers;

    /**
     * Request constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->transport = new GuzzleTransport();
        $this->data = $data;
        $this->headers = false;
    }

    /**
     * @param ITransport $transport
     */
    public function setTransport(ITransport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * Создание curl подключения
     *
     * @param string $url
     * @param null|array $params
     */
    public function init($url = "", $params = null)
    {
        $full_url = $this->base_url . $url;

        if (!is_null($params)) {
            $full_url .= "?";
            foreach ($params as $param_key => $param_value) {
                $params[$param_key] = $param_key . "=" . $param_value;
            }
            $full_url .= implode("&", $params);
        }

        $this->transport->setUrl($full_url);
        $this->transport->init();

    }

    /**
     * Установка нужных заголовков
     */
    protected function initHeaders()
    {
        if (empty($this->headers)) {
            return;
        }
        /** Удаляем пустые заголовки */
        $this->headers = array_filter($this->headers);

        $result_headers = [];
        foreach ($this->headers as $key => $value) {
            if (is_array($value)) {
                $full_value = "";
                foreach ($value as $key_inner => $value_inner) {
                    if (!empty($value_inner)) {
                        $full_value .= $key_inner . "=" . $value_inner . "; ";
                    }
                }
                $result_headers[] = $key . ": " . $full_value;
            } else {
                if (!empty($value)) {
                    $result_headers[] = $key . ": " . $value;
                }
            }
        }
        $this->transport->setHeaders($result_headers);
    }

    /**
     * @param bool $post_flag
     */
    protected function setPost($post_flag)
    {
        if ($post_flag) {
            $this->transport->setPost(true);
        }
    }


    /**
     * @param array $data
     */
    protected function setPostData($data)
    {
        if (!empty($data)) {
            $this->setPost(true);
            $this->transport->setPostData($data);
        }
    }

    /**
     * Действия перед отправкой запроса
     */
    protected function preRequest()
    {
        //        some code
    }


    /**
     * Действия после отправки запроса
     */
    protected function postRequest()
    {
        //        some code
    }


    /**
     * @param array $headers
     */
    protected function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Добавляет заголовок
     *
     * @param $header_name
     * @param $header_value
     */
    protected function addHeader($header_name, $header_value)
    {
        $this->headers[$header_name] = $header_value;
    }

    /**
     * Шаблонный метод
     * @return array
     * @throws \Exception
     */
    public function send()
    {
        $this->preRequest();
        $this->initHeaders();
        $result = $this->transport->send();
        $this->postRequest();
        $result = json_decode($result, true);
        return $result;

    }

    public function __destruct()
    {
        if (!is_null($this->transport)) {
            $this->transport->close();
        }
    }
}