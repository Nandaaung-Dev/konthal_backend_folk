<?php

namespace App\Repositories\Api\System\V1;

use App\Models\Branch;
use App\Repositories\BaseRepository;

class BranchRepository extends BaseRepository
{
    public function model()
    {
        return Branch::class;
    }
}
