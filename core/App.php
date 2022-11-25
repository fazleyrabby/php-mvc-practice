<?php 

namespace App\Core;


class App {
    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    public static App $app;
    public Controller $controller;
    public Session $session;
    public Database $db;

    public function __construct($root, array $config)
    {
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function setController(Controller $controller)
    {   
        $this->controller = $controller;
    }

    public function getController()
    {   
        return $this->controller;
    }
    
}