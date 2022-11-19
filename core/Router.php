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


        // die(print_r($this->routes));
        // die(print_r($callback));
        // return new PageController;
        // return $callback[0];

        // $request_uri = trim($_SERVER['REQUEST_URI'],"/");

        // $request_uri = (strpos($request_uri, "?")) ? substr($request_uri, 0, strpos($request_uri, "?")) : $request_uri;

        // die($request_uri);

        // $routeName = (strpos($path, ":")) ? substr($path, 0, strpos($path, ":")) : $path;

        // if($request_uri == $routeName){
        //     if(is_array($callback)){
        //         $instance = new $callback[0];
        //         $method = $callback[1];
        //         echo $instance->$method();
        //     }
        // }
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderContent("<h1 style='color:red;font-size:3rem;text-align:center'>Not found!</h1>");
        }

        if (is_string($callback)) {
            return $this->render($callback);
        }

        return call_user_func($callback);
    }

    public function render($view)
    {
        $layout = $this->layout();
        $content = $this->renderOnlyView($view);
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
        ob_start();
        if(file_exists(App::$ROOT_DIR . "/views/layouts/master.php")){
            include_once App::$ROOT_DIR . "/views/layouts/master.php";
        }
        
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        if(file_exists(App::$ROOT_DIR . "/views/$view.php")){
            include_once App::$ROOT_DIR . "/views/$view.php";
        }
        
        return ob_get_clean();
    }
}
