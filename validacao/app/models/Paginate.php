<?php


namespace app\models;


use app\traits\Links;

class Paginate
{

    use Links;

    private $page;
    private $perPage;
    private $offset;
    private $records;
    private $pages;

    public function paginate($perPage)
    {
        $this->current();
        $this->perPage($perPage);
        $this->offset();
        $this->pages();;
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
        $this->page = $_GET['page'] ?? 1;
    }

    private function perPage($perPage)
    {
        $this->perPage = $perPage ?? 10;
    }

    private function offset()
    {
        $this->offset = ($this->page * $this->perPage) - $this->perPage;
    }

    private function pages()
    {
        $this->pages = ceil($this->records / $this->perPage);
        $this->isValidateNumberPage();
    }

    private function isValidateNumberPage()
    {
        if (($this->page > $this->pages) || $this->page < 0) {
            return back();
        }

        return $this->pages;
    }
}