<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Filterable
{
    private $filters = [];
    private $search = null;
    public function setFilters(array $filters)
    {
        $this->filters = Arr::except($filters, 'search');
        $this->search = $filters['search'] ?? null;
    }
    // public function setSearch($search = null)
    // {
    //     $this->search = $search;
    // }
}
