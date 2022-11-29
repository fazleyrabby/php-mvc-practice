<?php
use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\App;
use App\Models\User;
use Dotenv\Dotenv;

require_once __DIR__."/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();



$root = dirname(__DIR__);

$config=[
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];




$app = new App($root, $config);
$route = $app->router;


$route->get('/', [SiteController::class, 'home']);
$route->get('/blogs', [SiteController::class, 'blogs']);
$route->get('/contact', [SiteController::class, 'contact']);
$route->post('/contact', [SiteController::class, 'handleContact']);

$route->get('/login', [AuthController::class, 'login']);
$route->post('/login', [AuthController::class, 'login']);
$route->get('/register', [AuthController::class, 'register']);
$route->post('/register', [AuthController::class, 'register']);
$route->get('/logout', [AuthController::class, 'logout']);
$route->get('/profile', [AuthController::class, 'profile']);

$app->run();




 

