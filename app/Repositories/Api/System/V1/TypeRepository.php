<?php

namespace App\Repositories\Api\System\V1;



use App\Models\Type;
use App\Repositories\BaseRepository;

class TypeRepository extends BaseRepository
{
    public function model()
    {
        return Type::class;
    }
}
