<?php

namespace App\Repositories\Api\System\V1;


use App\Models\Department;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository
{
    public function model()
    {
        return Department::class;
    }
}
