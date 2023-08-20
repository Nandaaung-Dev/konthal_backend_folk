<?php

namespace App\Repositories\Api\Shop\V1;

use App\Repositories\BaseRepository;
use App\Models\Attribute;

class AttributeRepository extends BaseRepository
{
    public function model()
    {
        return Attribute::class;
    }
}
