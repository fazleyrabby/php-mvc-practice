<?php

namespace App\Core;
require 'Helpers.php';

class Router
{
    // public function get(string $routeName, $callback)
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->render("404");
        }

        if (is_string($callback)) {
            return $this->render($callback);
        }

        if(is_array($callback)){
            App::$app->controller =  new $callback[0]();
            $callback[0] = App::$app->controller;
        }

        return call_user_func($callback, $this->request);
    }

    public function render($view, $params = [])
    {
        $layout = $this->layout();
        $content = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $content, $layout);
        // include_once App::$ROOT_DIR."/views/$view.php";
    }

    public function renderContent($content)
    {
        $layout = $this->layout();
        return str_replace('{{content}}', $content, $layout);
    }

    protected function layout()
    {
        $layout = App::$app->controller->layout;
        ob_start();
        if(file_exists(App::$ROOT_DIR . "/views/layouts/$layout.php")){
            include_once App::$ROOT_DIR . "/views/layouts/$layout.php";
        }

        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value){
            $$key = $value;
        }
    
        ob_start();
        if(file_exists(App::$ROOT_DIR . "/views/$view.php")){
            include_once App::$ROOT_DIR . "/views/$view.php";
        }
        
        return ob_get_clean();
    }
}
