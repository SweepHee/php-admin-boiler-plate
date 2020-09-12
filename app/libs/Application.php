<?php

namespace app\libs;
use Route;

class Application
{

    /*
     * $controller : 컨트롤러이름. ex) UserController...
     * $method : 컨트롤러의 메서드이름. ex) function index() {}
     * $request : 메서드에 전달한 파라미터. $_GET or $_POST
     * */
    public function __construct()
    {

        // URL 검증.
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

        // 현재 페이지에 요청된 정보
        $connectionPathInfo = Route::getDetect();
        $controller = $connectionPathInfo['controller'];
        $method = $connectionPathInfo['method'];
        $request = $connectionPathInfo['request'];

        // 컨트롤러 path에 존재하지 않는 컨트롤러는 404처리
        if (!file_exists(__PATH__."/app/controllers/{$controller}.php")) {
            http_response_code(404);
            require_once(__PATH__."/views/404.php");
            exit;
        }
        
        // 컨트롤러 선언을 위한 문자열
        $defineController = "\app\controllers\\{$controller}";

        // 컨트롤러 선언.
        $app = new $defineController();

        // 메소드 실행
        $app->$method($request);
    }
    
    
}