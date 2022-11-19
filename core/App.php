<?php 

namespace App\Core;

class App {
    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    
    public function __construct($root)
    {
        self::$ROOT_DIR = $root;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    
}