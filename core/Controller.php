<?php 

namespace App\Core;

use App\Core\Middlewares\BaseMiddleware;

class Controller{
    public string $layout = 'master';
    public string $action = '';
    /**
     * @var \App\Core\Middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function view($view, $params=[])
    {
        return App::$app->view->render($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middlewares)
    {
        $this->middlewares[] = $middlewares;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

}