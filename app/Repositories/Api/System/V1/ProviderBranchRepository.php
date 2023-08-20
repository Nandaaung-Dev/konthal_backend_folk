<?php

namespace App\Repositories\Api\System\V1;


use App\Models\ProviderBranche;
use App\Repositories\BaseRepository;

class ProviderBranchRepository extends BaseRepository
{
    public function model()
    {
        return ProviderBranche::class;
    }
}
