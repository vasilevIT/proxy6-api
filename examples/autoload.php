<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:04
 */

require_once __DIR__ . "/../vendor/autoload.php";
spl_autoload_register(function ($class) {
    $class = str_replace("ProxyAPI", "src", $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $class .= ".php";
    $class = __DIR__ . "/../" . $class;
    if (file_exists($class)) {
        require_once $class;
    }
});