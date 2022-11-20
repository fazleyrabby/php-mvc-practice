<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\App;

$root = dirname(__DIR__);

$app = new App($root);
$route = $app->router;


$route->get('/', [SiteController::class, 'home']);
$route->get('/blogs', [SiteController::class, 'blogs']);
$route->get('/contact', [SiteController::class, 'contact']);
$route->post('/contact', [SiteController::class, 'handleContact']);

$route->get('/login', [AuthController::class, 'login']);
$route->post('/login', [AuthController::class, 'login']);
$route->get('/register', [AuthController::class, 'register']);
$route->post('/register', [AuthController::class, 'register']);

$app->run();




 

