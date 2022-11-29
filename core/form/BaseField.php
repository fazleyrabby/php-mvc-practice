<?php 


namespace App\Core\Form;

use App\Core\Model;

abstract class BaseField{

    public Model $model;
    public string $attribute;
    public array $options;

    public function __construct(Model $model, string $attribute, $options = [])
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->options = $options;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf(
            '
        <div class="mb-3 form-group">
            <label for="name" class="form-label">%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
        </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}