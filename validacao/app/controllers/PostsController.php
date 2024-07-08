<?php

namespace app\controllers;

use app\models\Post;

class PostsController extends Controller
{

    protected $post;

    public function __construct()
    {
        $this->post = new Post;
    }

    public function index()
    {
        $posts = $this->post->all();

        $this->view('posts', [
            'title' => 'Lista de Posts',
            'posts' => $posts
        ]);
    }
}