<?php

namespace App\Models;

use App\Core\DbModel;
use App\Core\Model;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $confirmedPassword = '';
    public int $status = self::STATUS_INACTIVE;

    public function tableName(): string
    {
        return 'users';
    }

    public function save()
    {

        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED, self::RULE_EMAIL,
                [
                    self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'email'
                ]
            ],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 8]],
            'confirmedPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return ['name', 'email', 'password', 'status'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmedPassword' => 'Confirmed Password',
        ];
    }
}
