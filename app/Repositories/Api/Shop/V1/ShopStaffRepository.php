<?php

namespace App\Repositories\Api\Shop\V1;


use App\Models\ShopStaff;
use App\Repositories\BaseRepository;

class ShopStaffRepository extends BaseRepository
{
    public function model()
    {
        return ShopStaff::class;
    }
}
