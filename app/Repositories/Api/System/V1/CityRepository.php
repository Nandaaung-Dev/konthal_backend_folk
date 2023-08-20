<?php

namespace App\Repositories\Api\System\V1;

use App\Models\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    public function model()
    {
        return City::class;
    }
}
