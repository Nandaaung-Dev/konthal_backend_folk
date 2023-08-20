<?php

namespace App\Repositories\Api\System\V1;


use App\Models\Shop;
use App\Repositories\BaseRepository;

class ShopRepository extends BaseRepository
{
    public function model()
    {
        return Shop::class;
    }
}
