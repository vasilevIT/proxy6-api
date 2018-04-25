<?php
/**
 * Created by PhpStorm.
 * User: Anton Vasiliev <bysslaev@gmail.com>
 * Date: 25/04/2018
 * Time: 20:02
 */

use ProxyAPI\ProxyAPIFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $factory = new ProxyAPIFactory();
    $api = $factory->createProxyApi('proxy6');

    $response = $api->check($_POST['proxy']);
    echo "<pre>";
    print_r($response);
}

?>

<html>
<head>
    <title>Check proxy</title>
</head>
<body>
<form>
    <div>
        <label>
            Proxy
            <input type="text" name="proxy" value="<?= $_POST['proxy'] ?>">
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
