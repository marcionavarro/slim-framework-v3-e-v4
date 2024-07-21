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

        $login = new Login;
        $loggedIn = $login->type('admin')->login($data, new Users);

        $this->view('home', [
            'title' => 'Home',
            'users' => $users,
            'links' => $user->links(),
        ]);
    }
}