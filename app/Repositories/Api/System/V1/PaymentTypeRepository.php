<?php

namespace App\Repositories\Api\System\V1;


use App\Models\PaymentType;
use App\Repositories\BaseRepository;

class PaymentTypeRepository extends BaseRepository
{
    public function model()
    {
        return PaymentType::class;
    }
}
