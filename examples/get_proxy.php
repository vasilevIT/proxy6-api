<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 21:06
 */

require_once __DIR__ . "/autoload.php";

use ProxyAPI\ProxyAPIFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $factory = new ProxyAPIFactory();
    $api = $factory->createProxyApi('proxy6');
    $api->setApiKey($_POST['api_key']);
    $response = $api->getProxy();
    echo "<pre>";
    var_dump($response);
    print_r($response);
}

?>

<html>
<head>
    <title>Check proxy</title>
</head>
<body>
<form method="post">
    <div>
        <label>
            Api key
            <input type="text" name="api_key" value="<?= $_POST['api_key'] ?>">
        </label>
    </div>
    <div>
        <label>
            <input type="submit" name="summit" value="check">
        </label>
    </div>
</form>
</body>
</html>