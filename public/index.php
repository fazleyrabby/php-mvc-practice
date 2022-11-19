<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Core\App;

// namespace Core;
// use Core\App\Controllers\PageController;
// use Core\Router;

// use App\Router;

// use App\Router;

// include_once "core/autoload.php";


$app = new App((dirname(__DIR__)));

// $route->get('page/edit/:id', [PageController::class, 'edit']);

// $app->router->get('page/index', [PageController::class, 'index']);

// $app->router->get('page/create', [PageController::class, 'create']);
$app->router->get('/', 'home');
$app->router->get('/blogs', 'blogs');
$app->router->get('/contact', 'contact');

$app->run();
// $app = new App();



 

