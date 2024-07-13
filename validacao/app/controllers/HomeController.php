<?php

namespace app\controllers;

use app\models\Users;

class HomeController extends Controller
{
    public function index()
    {
        $users = new Users;
        $users = $users->select()->first();

        dd($users);

        $this->view('home', [
            'nome' => 'Marcio',
            'title' => 'Home'
        ]);
    }
}