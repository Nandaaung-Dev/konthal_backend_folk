<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\Provider;
use App\Repositories\BaseRepository;

class ProviderRepository extends BaseRepository
{
    public function model()
    {
        return Provider::class;
    }
}
