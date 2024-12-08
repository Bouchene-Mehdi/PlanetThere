<?php
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php';


// $request = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if(isset($routes[$method][$request])) {
 list($controller, $action) = explode('@', $routes[$method][$request]);


 require_once __DIR__ . '/../app/controllers/' . $controller . '.php';

 $controllerInstance = new $controller; 
 
 $controllerInstance->$action();

} else {

    http_response_code(404);
    echo "404 Not found";
}
   
