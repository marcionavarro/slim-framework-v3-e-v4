<?php

namespace app\controllers;

use app\models\Users;

class HomeController extends Controller
{
    public function index()
    {
        $users = new Users;
        $users = $users->select()->get();

        dd($users);

        $this->view('home', [
            'users' => $users,
            'title' => 'Home'
        ]);
    }
}