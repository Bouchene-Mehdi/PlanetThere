<?php

class Route{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controller){
        $this->routes['GET'][$uri] = $controller;
    }
    public function post($uri, $controller){
        $this->routes['POST'][$uri] = $controller;

    }

    public function formatRoutes($route){
        return '/'.trim($route, '/');
    }
    public function dispatch(){
        $method= $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $cleanedRequest= $this->formatRoutes($requestUri);
        if($this->match($method, $cleanedRequest)){
            $controller =$this->match($method, $cleanedRequest);
            list($controller_in_question, $action) = explode('@', $controller['controller']);
            $params = $controller['params'];
            $this->callAction($controller_in_question, $action, $params);

        }

    }
    public function match($method, $requestUri){
        foreach($this->routes[$method] as $uri => $controller){
            $pattern=preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_]+)', $uri);
            if(preg_match('#^'.$pattern.'$#', $requestUri, $matches)){
                array_shift($matches);
                return [
                    'controller' => $controller,
                    'params' => $matches
                ];
            }
        }
        return false;
     }
     protected function callAction($controller, $action, $parameters = []) {
        require_once __DIR__ . '/../controllers/'. '/'. $controller . '.php';
        $controllerInstance = new $controller;
        call_user_func_array([$controllerInstance, $action], $parameters);
     }
}
