<?php

namespace app\traits;

trait Create
{
    public function create($attributes)
    {
        $sql = "INSERT INTO {$this->table} ";
        $sql .= '(' . implode(',', array_keys($attributes)) . ')';
        $sql .= ' VALUES (:' . implode(', :', array_keys($attributes)) . ')';

        $create = $this->connect->prepare($sql);
        $create->execute($attributes);

        return $this->connect->lastInsertId();
    }
}