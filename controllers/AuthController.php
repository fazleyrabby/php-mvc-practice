<?php 

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller{
    public function login()
    {
        $this->setLayout('auth');
        return $this->view('login');
    }

    public function register(Request $request)
    {
        $register = new RegisterModel();
        $this->setLayout('auth');
        if($request->isPost()){
            
            $register->loadData($request->getBody());

            
            if($register->validate() && $register->register()){
                return 'Success';
            }
            // echo "<pre>";var_dump($register);exit;

            return $this->view('register', [
                'model' => $register
            ]);
        }
        
        return $this->view('register', [
            'model' => $register
        ]);
    }
}