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
        $post = new Post;
        $posts = $post->posts()->search('title')->order('users.id', 'DESC')->paginate(10)->get();

        $this->view('posts', [
            'title' => 'Posts',
            'posts' => $posts,
            'links' => $post->links(),
        ]);
    }
}