<?php

namespace App\Repositories\Dashboard\System;

use App\Models\Region;
use App\Repositories\BaseRepository;

class RegionRepository extends BaseRepository{
    protected function model()
    {
        return Region::class;
    }
}


