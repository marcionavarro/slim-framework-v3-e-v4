<?php


namespace app\models;


class Paginate
{

    private $perPage;
    private $offset;
    private $records;
    private $pages;

    public function paginate($perPage)
    {
        $this->current();
        $this->perPage($perPage);
        $this->offset();
        $this->pages();

        return $this;
    }

    public function sqlPaginate()
    {
        return " LIMIT {$this->perPage} OFFSET {$this->offset}";
    }

    public function records($records)
    {
        $this->records = $records;
    }

    private function current()
    {
        $this->pages = $_GET['page'] ?? 1;
    }

    private function perPage($perPage)
    {
        $this->perPage = $perPage ?? 10;
    }

    private function offset()
    {
        $this->offset = ($this->pages * $this->perPage) - $this->perPage;
    }

    private function pages()
    {
        $this->pages = ceil($this->records / $this->perPage);
    }
}