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
            'email' => 'required:email:unique@users',
            'phone' => 'required:phone'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        dd($data);
    }
}