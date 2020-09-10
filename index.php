<?php

/* config */
require_once(__DIR__."/config/config.php");

/* autoload */
require_once(__DIR__."/vendor/autoload.php");

/* modules */
require_once(__DIR__."/modules/common.php");




$app = new app\libs\Application();
exit;


$payload = CONVERT_TO_REQUEST();

switch ($router)
{
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case 'user' :
        $test = new app\controller\userController($request, $payload);
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/asd/create' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}