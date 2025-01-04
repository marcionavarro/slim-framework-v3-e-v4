<?php


namespace app\controllers\admin;


use app\controllers\Controller;
use app\models\admin\Admin;
use app\src\Login;
use app\src\Validate;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('admin.login', []);
    }

    public function store()
    {
        $validate = new Validate();
        $data = $validate->validate([
            'email' => 'required:email',
            'password' => 'required',
        ]);

        if ($validate->hasErrors()) {
            return back();
        }

        $login = new Login('admin');
        $loggedIn = $login->login($data, new Admin);

        if (!$loggedIn) {
            flash('message', error('Erro ao logar, email ou senha inválidos'));
            return back();
        }

        return redirect('/admin/painel');
    }
}