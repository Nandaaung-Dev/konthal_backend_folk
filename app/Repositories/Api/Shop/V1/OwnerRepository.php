<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\Owner;
use App\Repositories\BaseRepository;

class OwnerRepository extends BaseRepository
{
    public function model()
    {
        return Owner::class;
    }
}
