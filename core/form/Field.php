<?php

namespace App\Core\Form;

use App\Core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function __toString()
    {
        return sprintf('
        <div class="mb-3 form-group">
            <label for="name" class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" aria-describedby="emailHelp" class="form-control %s">
                <div class="invalid-feedback">
                    %s
                </div>
        </div>', 
        $this->model->getLabel($this->attribute), 
        $this->type, 
        $this->attribute, 
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}
