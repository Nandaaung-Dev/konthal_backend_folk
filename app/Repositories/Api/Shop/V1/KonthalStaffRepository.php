<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\KonthalStaff;
use App\Repositories\BaseRepository;

class KonthalStaffRepository extends BaseRepository
{
    public function model()
    {
        return KonthalStaff::class;
    }
}
