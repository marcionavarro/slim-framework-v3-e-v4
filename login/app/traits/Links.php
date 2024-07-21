<?php


namespace app\traits;


trait Links
{
    protected $maxLinks = 3;
    public $size;
    public $align;
    public $firstLink;
    public $back;
    public $advanced;
    public $lastLink;

    public function __construct(
        $size = 'md',
        $align = 'start',
        $firstLink = '[1]',
        $back = '',
        $advanced = '',
        $lastLink = '')
    {
        $this->size = $size;
        $this->align = $align;
        $this->firstLink = $firstLink;
        $this->back = $back;
        $this->advanced = $advanced;
        $this->lastLink = $lastLink;
    }

    public function links()
    {
        if ($this->pages > 0) {
            $links = '<nav aria-label="...">';
            $links .= "<ul class='pagination pagination-{$this->size} justify-content-{$this->align}'>";
            $links .= $this->previous();

            for ($i = $this->page - $this->maxLinks; $i <= $this->page + $this->maxLinks; $i++) {
                $class = ($i == $this->page) ? 'active' : '';
                $linkOrSpan = ($i == $this->page) ?
                    "<span class='page-link {$class}'>{$i}</span>" :
                    "<a class='page-link {$class}' href='{$this->pageRequest()}{$i}'>{$i}</a>";

                if ($i > 0 && $i <= $this->pages) {
                    $links .= "<li class='page-item'>";
                    $links .= $linkOrSpan;
                    $links .= "</li>";
                }
            }

            $links .= $this->next();
            $links .= '</ul>';
            $links .= '</nav>';

            return $links;
        }
    }

    private function pageRequest()
    {
        return (!search()) ?
            $page = "?page=" :
            $page = "?s=" . search() . "&page=";
    }

    private function previous()
    {
        if ($this->page > 1) {
            $preview = ($this->page - 1);
            $back = !empty($this->back) ? $this->back : '&laquo;';

            $links = "<li class='page-item'><a class='page-link' href='{$this->pageRequest()}1' aria-label='Previous'>{$this->firstLink}</a></li>";
            $links .= "<li class='page-item'><a class='page-link' href='{$this->pageRequest()}{$preview}' aria-label='Previous'>";
            $links .= "<span aria-hidden='true'>{$back}</span>";
            $links .= "</a></li>";

            return $links;
        }
    }

    private function next()
    {
        if ($this->page < $this->pages) {
            $lastLink = !empty($this->lastLink) ? $this->lastLink : "[$this->pages]";
            $advanced = !empty($this->advanced) ? $this->advanced : '&raquo;';

            $next = ($this->page + 1);
            $links = "<li class='page-item'><a class='page-link' href='{$this->pageRequest()}{$next}' aria-label='Previous'>";
            $links .= "<span aria-hidden='true'>{$advanced}</span>";
            $links .= "<li class='page-item'><a class='page-link' href='{$this->pageRequest()}{$this->pages}' aria-label='next'>{$lastLink}</a></li>";
            $links .= "</a></li>";

            return $links;
        }
    }

}