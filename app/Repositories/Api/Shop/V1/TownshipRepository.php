<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\Township;
use App\Repositories\BaseRepository;

class TownshipRepository extends BaseRepository
{
    public function model()
    {
        return Township::class;
    }
}
