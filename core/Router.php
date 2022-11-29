<?php

namespace App\Core;

use App\Core\Exception\NotFoundException;

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
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return App::$app->view->render($callback);
        }

        if(is_array($callback)){
            /**
             * @var \App\Core\Controller $controller
             */
            $controller =  new $callback[0]();
            App::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
            
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function render($view, $params = [])
    {
        return App::$app->view->render($view, $params);
    }

}
