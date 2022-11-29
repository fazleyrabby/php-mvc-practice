<?php 

namespace App\Core;

use App\Models\User;

class App {
    
    public string $layout = 'master';
    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    public static App $app;
    public ?Controller $controller = null;
    public Session $session;
    public Database $db;
    public string $userClass;
    public ?DbModel $user;
    public View $view;

    public function __construct($root, array $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $primaryValue = $this->session->get('user');
        
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->render('_error',[
                'exception' => $e
            ]);
        }
        
    }

    public function setController(Controller $controller)
    {   
        $this->controller = $controller;
    }

    public function getController()
    {   
        return $this->controller;
    }


    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }


    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
    
}