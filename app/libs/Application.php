<?php

namespace app\libs;

class Application
{

    public function __construct()
    {
        // URL 검증.
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        
        // 주소의 첫번째 파라미터 = 컨트롤러명
        $controller = explode("/", $url)[1];
        
        // 컨트롤러 path에 존재하지 않는 컨트롤러는 404처리
        if (!file_exists("app/controllers/{$controller}Controller.php")) {
            http_response_code(404);
            require_once(__PATH__."/views/404.php");
            exit;
        }

        // 주소의 컨트롤러명을 제외한 나머지 문자뽑아냄 ex) /user/detail/1 -> /detail/1
        $request = preg_replace("/\/{$controller}/",'', $url,1);
        
        // 컨트롤러 선언을 위한 문자열
        $defineController = "\app\controllers\\{$controller}controller";

        // 컨트롤러 선언.
        new $defineController($request, $_POST);
    }

}