<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\ShopType;
use App\Repositories\BaseRepository;

class ShopTypeRepository extends BaseRepository
{
    public function model()
    {
        return ShopType::class;
    }
}
