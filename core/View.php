<?php 

namespace App\Core;

class View{
    public string $title = '';

    public function render($view, $params = [])
    {
        $content = $this->renderOnlyView($view, $params);
        $layout = $this->layout();
        
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
        $layout= App::$app->layout;
        if(App::$app->controller){
            $layout = App::$app->controller->layout;
        }
        
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