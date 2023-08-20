<?php

namespace App\Repositories\Api\System\V1;

use App\Models\LogStatus;
use App\Repositories\BaseRepository;

class LogStatusRepository extends BaseRepository
{
    public function model()
    {
        return LogStatus::class;
    }
}
