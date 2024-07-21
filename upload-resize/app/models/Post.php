<?php

namespace app\models;

class Post extends Model
{
    protected $table = 'posts';
    protected $sql;

    public function posts()
    {
        $this->sql = "SELECT * FROM {$this->table} INNER JOIN users ON users.id = posts.user";
        return $this;
    }
}
