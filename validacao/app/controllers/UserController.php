<?php

namespace app\controllers;

use app\models\Users;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new Users;
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $user = $this->user->select()->where('id', $args['id'])->first();

        $this->view('edit', [
            'title' => "Editar  user {$user->name}",
            'user' => $user
        ]);
    }

    public function update($request, $response, $args)
    {
        dd($args);
    }
}