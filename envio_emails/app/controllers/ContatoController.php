<?php

namespace app\controllers;

use app\src\Validate;

class ContatoController extends Controller
{
    public function index()
    {
        $this->view('contato', [
            'title' => 'Contato',
            'nome' => 'Marcio'
        ]);
    }

    public function store()
    {
        $validate = new Validate();
        $data = $validate->validate([
            'name' => 'required',
            'email' => 'required:email',
            'subject' => 'required',
            'mensagem' => 'required'
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $email = new Email;

        $email->data([
            'fromName' => $data->name,
            'toName' => 'Marcio Navarro',
        ])->template(new Contato)->send();
    }
}
