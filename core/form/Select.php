<?php

namespace App\Core\Form;

class Select extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<select name="%s" class="form-control %s">%s</select>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->renderOptions($this->options, $this->model->{$this->attribute})
        );
        
    }

    public function renderOptions($options, $selected) {
        $string = "";
        foreach($options as $key => $option){
            $s = $selected == $key ? 'selected' : '';
            $string .= "<option value='$key' $s>$option</option>";
        }
        return $string;
    }
}
