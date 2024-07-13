<?php

namespace app\traits;

trait Read
{
    private $sql;
    private $binds;

    public function select($fields = '*')
    {
        $this->sql = "SELECT {$fields} FROM {$this->table}";
        return $this;
    }

    public function where()
    {
        $num_args = func_num_args();
        $args = func_get_args();

        $args = $this->whereArgs($num_args, $args);

        $this->sql .= " WHERE {$args['field']} {$args['signal']} :{$args['field']}";
        $this->binds = [
            $args['field'] => $args['value']
        ];

        return $this;
    }

    public function get()
    {
        $select = $this->bindAndExecute();
        return $select->fetchAll();
    }

    public function first()
    {
        $select = $this->bindAndExecute();
        $select->execute();

        return $select->fetch();
    }

    private function whereArgs($numArgs, $args)
    {
        if ($numArgs < 2) {
            throw new \Exception("Opss, algo errado aconteceu, o where precisa de no minímo 2 argumentos");
        }

        if ($numArgs > 3) {
            throw new \Exception("Opss, algo errado aconteceu, o where não pode ter mais que 3 argumentos");
        }

        if ($numArgs == 2) {
            $field = $args[0];
            $signal = '=';
            $value = $args[1];
        }

        if ($numArgs == 3) {
            $field = $args[0];
            $signal = $args[1];
            $value = $args[2];
        }

        return [
            'field' => $field,
            'signal' => $signal,
            'value' => $value
        ];
    }

    private function bindAndExecute()
    {
        $select = $this->connect->prepare($this->sql);
        $select->execute($this->binds);

        return $select;
    }
}
