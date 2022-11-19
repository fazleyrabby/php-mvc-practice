<?php 

namespace App\Models;

use App\Core\Model;

class RegisterModel extends Model{
    public string $name;
    public string $email;
    public string $password;
    public string $confirmedPassword;

    public function register(){
        echo "new user!";
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 8]],
            'confirmedPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

}