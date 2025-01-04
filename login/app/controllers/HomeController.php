<?php

namespace app\controllers;

use app\models\Users;
use app\src\Login;
use app\src\Password;

class HomeController extends Controller
{
    public function index()
    {
        $user = new Users;
        $users = $user->select()->search('name, email')->paginate(5)->get();
        $userLogado = false;
        //dd(Password::make('admin'));

        if ($_SESSION && $_SESSION['id_admin'] && $_SESSION['admin_login']) {
            $userLogado = true;
        }

        $this->view('home', [
            'title' => 'Home',
            'users' => $users,
            'links' => $user->links(),
            'logado' => $userLogado
        ]);

    }
}