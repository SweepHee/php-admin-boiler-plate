<?php


namespace app\controllers;


class AdminController extends _Controller
{
    private static $model;

    public function __construct($request, $payload)
    {
        require_once(__COMPONENT__."/admin/head.php");
        parent::__construct($request, $payload);
    }

    public function __destruct()
    {
        require_once(__COMPONENT__."/admin/footer.php");
    }

    public function route($request, $payload)
    {
        self::$model = new \app\models\AdminModel();

        switch($request)
        {
            case "":
            case "/":
                require_once __ADMIN__ . "/index.php";
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

}