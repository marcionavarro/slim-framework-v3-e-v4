<?php

namespace app\traits;

trait Validations
{
    private $errors = [];

    protected function required($field)
    {
        if (empty($_POST[$field])) {
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório'));
        }
    }

    protected function email($field)
    {
//        dd($_POST[$field]);
    }

    protected function phone($field)
    {
    }

    protected function unique($field)
    {
    }

    protected function max()
    {

    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

}