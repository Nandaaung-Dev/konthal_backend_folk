<?php
namespace App\Repositories\Dashboard\System;

use App\Models\ShopType;
use App\Repositories\BaseRepository;

class ShopTypeRepository extends BaseRepository{
    protected function model()
    {
        return ShopType::class;
    }
}
