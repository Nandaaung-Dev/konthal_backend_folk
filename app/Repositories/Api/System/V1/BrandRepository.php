<?php

namespace App\Repositories\Api\System\V1;

use App\Models\Brand;
use App\Repositories\BaseRepository;

class BrandRepository extends BaseRepository
{
    public function model()
    {
        return Brand::class;
    }
}
