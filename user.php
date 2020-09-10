<?php
/**
 * Created by PhpStorm.
 * User: BARAEM_programer2
 * Date: 2020-09-04
 * Time: 오후 3:37
 */
// header('Access-Control-Allow-Origin : http://localhost:3000'); // 예시. header('Access-Control-Allow-Origin : http://client.google.com');
// header('Access-Control-Allow-Credentials: true');
// header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
// header('Content-Type: application/json;charset=UTF-8');

// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     header('Access-Control-Allow-Origin: *');
//     header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
//     header('Access-Control-Allow-Headers: token, Content-Type');
//     header('Access-Control-Max-Age: 1728000');
//     header('Content-Length: 0');
//     header('Content-Type: text/plain');
//     die();
// }

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


$__rawBody = file_get_contents("php://input");
echo json_encode($__rawBody);
?>