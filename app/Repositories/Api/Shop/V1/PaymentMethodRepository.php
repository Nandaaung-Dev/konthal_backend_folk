<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\PaymentMethod;
use App\Repositories\BaseRepository;

class PaymentMethodRepository extends BaseRepository
{
    public function model()
    {
        return PaymentMethod::class;
    }
}
