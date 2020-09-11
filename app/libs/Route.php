<?php

class Route
{
    static $get = [
        "/index" =>
            [ "controller"=> "IndexController", "method"=>"index", "req" => "_GET" ]
        ];

    static $post = [
        "/index" =>
            [ "controller"=> "IndexController", "method"=>"index", "req"=> "_POST" ]
        ];

    private function __construct() {}


    public static function get($uri, $callback)
    {

        $req  = explode("@", $callback);
        self::$get[$uri] =
            [
                "controller" => $req[0],
                "method" => $req[1] != "" ? $req[1] : "index",
                "request" => $_GET
            ];

        // 주소에 :param 있을 경우 처리해주기
        if (self::IntParameterValidate($uri)) {
            self::$get[$uri]['path'] = $_SERVER['PATH_INFO'];
        }

    }

    public static function post($uri, $callback)
    {
        $req  = explode("@", $callback);
        self::$post[$uri] =
                [
                    "controller" => $req[0],
                    "method" => $req[1] != "" ? $req[1] : "index",
                    "request" => $_POST
                ];

        // 주소에 :param 있을 경우 처리해주기
        if (self::IntParameterValidate($uri)) {
            self::$get[$uri]['path'] = $_SERVER['PATH_INFO'];
        }

    }

    public static function request($uri, $callback)
    {

    }

    // 주소에 :param 있을 경우 처리해주기
    private static function IntParameterValidate($uri)
    {
        // ':' 가 있는지 ?
        if (strpos($uri, ":") !== false) {

            // Route에 매개변수 uri에서 :param => "" 다 지우기
            $validateDynamicUri = preg_replace("/(:)+([a-zA-Z0-9]+)/", "", $uri);

            // 주소에서 숫자부분 다 지우기
            $validateDynamicPathInfo = preg_replace("/[0-9]+/", "", $_SERVER['PATH_INFO']);

            // 두 개 지운 값 비교해서 똑같은 uri인지 확인하고 똑같다면 true
            if ($validateDynamicUri == $validateDynamicPathInfo) {
                return true;
            }
        }

        return false;
    }
}