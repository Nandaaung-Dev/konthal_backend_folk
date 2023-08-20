<?php

namespace App\Repositories\Dashboard\System;

use App\Models\Department;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository{
    protected function model()
    {
        return Department::class;
    }
}
