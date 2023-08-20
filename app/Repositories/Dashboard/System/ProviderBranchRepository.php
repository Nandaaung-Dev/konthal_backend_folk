<?php

namespace App\Repositories\Dashboard\System;

use App\Models\ProviderBranche;
use App\Repositories\BaseRepository;

class ProviderBranchRepository extends BaseRepository{
    protected function model()
    {
        return ProviderBranche::class;
    }
}
