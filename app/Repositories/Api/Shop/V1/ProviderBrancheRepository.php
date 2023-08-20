<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\ProviderBranche;
use App\Repositories\BaseRepository;

class ProviderBrancheRepository extends BaseRepository
{
    public function model()
    {
        return ProviderBranche::class;
    }
}
