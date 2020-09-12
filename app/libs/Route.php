<?php

class Route
{
    // GET 요청 정보
    static $get = [
        "/index" =>
            [
                "controller"=> "IndexController",
                "method"=>"index",
                "request" => "_GET",
                /* 만약 현재 들어온 페이지라면 아래 객체도 추가 */
                "path" => "/user/1",
                "uri" => "/user/:id"
            ]
        ];

    // POST 요청 정보
    static $post = [
        "/index" =>
            [
                "controller"=> "IndexController",
                "method"=>"index",
                "request"=> "_POST",
                /* 만약 현재 들어온 페이지라면 아래 객체도 추가 */
                "path" => "/user/1",
                "uri" => "/user/:id"
            ]
        ];

    // 현재 페이지라면 정의됨.
    private static $detect = [];

    private function __construct() {}


    public static function get($uri, $callback)
    {
        // get요청일 경우만 허용
        if ($_SERVER['REQUEST_METHOD'] !== "GET") return true;

        $req  = explode("@", $callback);
        self::$get[$uri] =
            [
                "controller" => $req[0],
                "method" => $req[1] != "" ? $req[1] : "index",
                "request" => $_GET,
            ];

        // 주소에 :param 있을 경우 처리해주기
        if (self::IntParameterValidate($uri)) {
            self::$get[$uri]['path'] = $_SERVER['PATH_INFO'];
            self::$get[$uri]['uri'] = $uri;
            self::$get[$uri]['rest'] = "get";
            self::$detect = self::$get[$uri];
        }
    }

    public static function post($uri, $callback)
    {
        // post요청일 경우만 허용
        if ($_SERVER['REQUEST_METHOD'] !== "POST") return true;

        $req  = explode("@", $callback);
        self::$post[$uri] =
                [
                    "controller" => $req[0],
                    "method" => $req[1] != "" ? $req[1] : "index",
                    "request" => $_POST,
                ];

        // 주소에 :param 있을 경우 처리해주기
        if (self::IntParameterValidate($uri)) {
            self::$post[$uri]['path'] = $_SERVER['PATH_INFO'];
            self::$post[$uri]['uri'] = $uri;
            self::$get[$uri]['rest'] = "post";
            self::$detect = self::$post[$uri];
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
            $validateDynamicUri = preg_replace("/(:)+([a-zA-Z0-9]+)(\/?)/", "", $uri);

            // 주소에서 숫자부분 다 지우기
            $validateDynamicPathInfo = preg_replace("/[0-9]+(\/?)/", "", $_SERVER['PATH_INFO']);

            // 두 개 지운 값 비교해서 똑같은 uri인지 확인하고 똑같다면 true
            if ($validateDynamicUri == $validateDynamicPathInfo) {
                return true;
            }
        }

        return false;
    }

    // 현재페이지 리턴
    public static function getDetect()
    {
        return self::$detect;
    }
}