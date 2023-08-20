<?php

namespace App\Repositories\Api\System\V1;


use App\Models\Owner;
use App\Repositories\BaseRepository;

class OwnerRepository extends BaseRepository
{
    public function model()
    {
        return Owner::class;
    }
}
