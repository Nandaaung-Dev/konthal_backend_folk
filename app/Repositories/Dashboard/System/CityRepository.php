<?php

namespace App\Repositories\Dashboard\System;

use App\Models\City;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    protected function model()
    {
        return City::class;
    }
}
