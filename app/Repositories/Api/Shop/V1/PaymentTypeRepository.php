<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\PaymentType;
use App\Repositories\BaseRepository;

class PaymentTypeRepository extends BaseRepository
{
    public function model()
    {
        return PaymentType::class;
    }
}
