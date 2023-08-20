<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    public function model()
    {
        return City::class;
    }
}
