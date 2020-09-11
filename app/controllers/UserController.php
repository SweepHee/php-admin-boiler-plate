<?php

namespace app\controllers;
use app\models\UserModel;

class UserController extends _Controller
{
    private static $model;

    public function __construct()
    {
        self::$model = new UserModel();
    }

    public function index($payload)
    {
        require_once(__VIEW__."/index.php");
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

    public function test($payload)
    {
        echo "^^;;;";
    }


}
