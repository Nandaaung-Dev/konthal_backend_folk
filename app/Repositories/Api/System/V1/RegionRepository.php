<?php

namespace App\Repositories\Api\System\V1;

use App\Models\Region;
use App\Repositories\BaseRepository;

class RegionRepository extends BaseRepository
{
    public function model()
    {
        return Region::class;
    }
}
