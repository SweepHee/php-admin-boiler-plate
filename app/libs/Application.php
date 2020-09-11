<?php

namespace app\libs;
use Route;

class Application
{

    public function __construct()
    {
        // URL 검증.
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

        // get, post 요청 선택
        if (!$_POST) {
            $controller = Route::$get[$url]['controller'];
            $method = Route::$get[$url]['method'];
            $req = Route::$get[$url]['req'];
        }
        else {
            $controller = Route::$post[$url]['controller'];
            $method = Route::$post[$url]['method'];
            $req = Route::$post[$url]['req'];
        }

        echo "<pre>";
        print_r(Route::$get);
        echo "</pre>";

        // 컨트롤러 path에 존재하지 않는 컨트롤러는 404처리
        if (!file_exists("app/controllers/{$controller}.php")) {
            http_response_code(404);
            require_once(__PATH__."/views/404.php");
            exit;
        }
        
        // 컨트롤러 선언을 위한 문자열
        $defineController = "\app\controllers\\{$controller}";

        // 컨트롤러 선언.
        $app = new $defineController();

        // 메소드 실행
        $app->$method($req);
    }
    
    
}