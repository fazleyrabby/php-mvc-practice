<?php 

namespace App\Core;

class Controller{
    public string $layout = 'master';

    public function view($view, $params=[])
    {
        return App::$app->router->render($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}