<?php
namespace App\Repositories\Dashboard\System;

use App\Models\Township;
use App\Repositories\BaseRepository;

class TownshipRepository extends BaseRepository{
    protected function model()
    {
        return Township::class;
    }
}
