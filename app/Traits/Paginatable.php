<?php

namespace App\Traits;

trait Paginatable
{
    private $pagination = null;
    private $sortBy = 'created_at';
    private $sortOrder = 'desc';
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }
    public function setSortBy($sortBy = 'created_at')
    {
        $this->sortBy = $sortBy;
    }

    public function setSortOrder($sortOrder = 'desc')
    {
        $this->sortOrder = $sortOrder;
    }
}
