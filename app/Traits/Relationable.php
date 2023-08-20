<?php

namespace App\Traits;

trait Relationable
{
    private $relations = [];
    public function setRelations($relations = null)
    {
        $this->relations = $relations;
    }
}
