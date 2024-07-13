<?php

namespace app\models;

class Model
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Connection::connect();
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $all = $this->connect->query($sql);
        $all->execute();

        return $all->fetchAll();
    }
}