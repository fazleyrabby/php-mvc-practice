<?php

namespace App\Models;

use App\Core\App;
use App\Core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function tableName(): string
    {
        return 'users';
    }



    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }


    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if(!$user){
           $this->addError('email', 'User does not exist');
           return false;
        }
        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        // echo"<pre>";var_dump($user);exit;

        return App::$app->login($user);

    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

}
