<?php

namespace app\controllers;

use app\models\Post;
use app\models\Users;

class HomeController extends Controller
{
    public function index()
    {
        $user = new Users;
        $users = $user->select()->search('name, email')->paginate(5)->get();

        $this->view('home', [
            'title' => 'Home',
            'users' => $users,
            'links' => $user->links(),
        ]);
    }
}