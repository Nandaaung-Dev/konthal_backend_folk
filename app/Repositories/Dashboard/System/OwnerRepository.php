<?php

namespace App\Repositories\Dashboard\System;

use App\Models\Owner;
use App\Repositories\BaseRepository;

class OwnerRepository extends BaseRepository{
    protected function model()
    {
        return Owner::class;
    }
}
