<?php


namespace app\controllers;
use app\models\FormModel;

class FormController extends _Controller
{
    private static $model;

    public function __construct()
    {
        self::$model = new FormModel();
    }

    public function index($payload)
    {
        echo "shibar~";
        require_once(__VIEW__."/index.php");
    }

}