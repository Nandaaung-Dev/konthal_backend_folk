<?php

namespace App\Repositories\Dashboard\System;

use App\Models\Shop;
use App\Repositories\BaseRepository;

class ShopRepository extends BaseRepository{
    protected function model()
    {
        return Shop::class;
    }
}
