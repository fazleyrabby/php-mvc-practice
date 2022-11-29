<?php

namespace App\Models;

use App\Core\App;
use App\Core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';
    public string $select = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
            'select' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Subject',
            'email' => 'Email',
            'body' => 'Body',
            'select' => 'Select',
        ];
    }

    public function send()
    {
        return true;
    }

}
