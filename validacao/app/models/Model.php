<?php

namespace app\models;

use app\traits\{
    Create,
    Read,
    Update,
    Delete
};

abstract class Model
{
    use Create, Read, Update, Delete;

    protected $connect;
    protected $field;
    protected $value;

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

    public function find($field, $value)
    {
        $this->field = $field;
        $this->value = $value;

        return $this;
    }

    public function destroy($field, $value)
    {
        if (!isset($field) or !isset($value)) {
            throw new \Exception("Antes de fazer o update, por favor chame o delete");
        }

        $sql = "DELETE FROM {$this->table} WHERE {$field} = :{$field}";
        $delete = $this->connect->prepare($sql);
        $delete->bindValue($field, $value);
        $delete->execute();

        return $delete->rowCount();
    }
}