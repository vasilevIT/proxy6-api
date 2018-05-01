# About
Library for working with proxy service
* proxy6.net

### Version
Current version 0.1.3

## Install via composer

```
composer require vasilevit/proxy6-api
```

## Usage
```php
$api = new \ProxyAPI\Proxy\Proxy6();
$api->setApiKey('api_key');
```
### Examples
```php
$proxies = $api->getProxy(\ProxyAPI\Proxy\ProxyState::ACTIVE);
    
$response = $api->buy(1, 7, "ru");
$bought_proxy = $response->list[0];
    
$api->prolong(14, [1, 4, 5]);
    
$response = $api->check($_POST['proxy']);
if ($response->proxy_status) {
    //active proxy
}
```

