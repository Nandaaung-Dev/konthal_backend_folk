<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\ShopDepartment;
use App\Repositories\BaseRepository;

class ShopDepartmentRepository extends BaseRepository
{
    public function model()
    {
        return ShopDepartment::class;
    }
}
