<?php

function userRouter($request, $payload)
{

    $user = new model\user();
    $response = null;

    switch($request)
    {
        case "/user/view" :
            echo json_encode("hello!");
            break;
        case "/user/create" :
            $response = $user->create($payload);
            echo json_encode($response);
            break;
        default:
            http_response_code(404);
            require dirname(__DIR__, 1) . '/views/404.php';
            break;
    }


}