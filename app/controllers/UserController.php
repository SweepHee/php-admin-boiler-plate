<?php

namespace app\controllers;

class UserController extends _Controller
{
    private static $model;

    public function route($request, $payload)
    {
        self::$model = new \app\models\UserModel();

        switch($request)
        {
            case "/user":
                echo "hi!";
                break;
            case "/user/list" :
                $response = $this->get($payload);
                echo json_encode($response);
                break;
            case "/user/create" :
                $response = $this->create($payload);
                echo json_encode($response);
                break;
            case "/user/check" :
                $response = $this->check($payload);
                echo json_encode($response);
                break;
            default:
                http_response_code(404);
                require __PATH__ . '/views/404.php';
                break;
        }
    }

    public function get($payload)
    {
        return self::$model->get($payload);
    }

    public function create($payload) 
    {
        return self::$model->create($payload);
    }

    public function check($payload)
    {
        return self::$model->check($payload);
    }


}
