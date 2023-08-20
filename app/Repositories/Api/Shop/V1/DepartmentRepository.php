<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\Department;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository
{
    public function model()
    {
        return Department::class;
    }
}
