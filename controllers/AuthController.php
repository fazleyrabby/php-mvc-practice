<?php 

namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller{
    public function login()
    {
        $this->setLayout('auth');
        return $this->view('login');
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
}