<?php
namespace App\Repositories\Dashboard\System;

use App\Models\Provider;
use App\Repositories\BaseRepository;

class ProviderRepository extends BaseRepository{
    protected function model()
    {
        return Provider::class;
    }
}
