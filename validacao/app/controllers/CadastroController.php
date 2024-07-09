<?php

namespace app\controllers;

use app\src\Validate;

class CadastroController extends Controller
{
    public function create()
    {
        $this->View('cadastro', [
            'title' => 'Cadastro'
        ]);
    }

    public function store()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'name' => 'required',
            'email' => 'required:email',
            'phone' => 'required:phone'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }
    }
}