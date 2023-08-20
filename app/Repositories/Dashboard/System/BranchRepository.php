<?php

namespace App\Repositories\Dashboard\System;

use App\Models\Branch;
use App\Repositories\BaseRepository;

class BranchRepository extends BaseRepository{
    protected function model()
    {
        return Branch::class;
    }
    
}
