<?php 

namespace App\Controllers;

use App\Core\App;
use App\Models\User;
use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Models\LoginForm;
use App\Core\Middlewares\AuthMiddleware;


class AuthController extends Controller{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());

            if($loginForm->validate() && $loginForm->login()){
                $response->redirect("/");
                return;
            }
        }
        $this->setLayout('auth');

        $data = [
            'model' => $loginForm
        ];
        return $this->view('login', $data);
    }

    public function register(Request $request)
    {
        $user = new User();
        $this->setLayout('auth');
        if($request->isPost()){
            $user->loadData($request->getBody());
        
            if($user->validate() && $user->save()){
                App::$app->session->setFlash('success','Successfully Registerd!');
                App::$app->response->redirect('/');
                exit;
            }

            return $this->view('register', [
                'model' => $user
            ]);
        }
        
        return $this->view('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        App::$app->logout();
        $response->redirect('/');
    }

    public function profile(Request $request)
    {
        return $this->view('profile');
    }
}