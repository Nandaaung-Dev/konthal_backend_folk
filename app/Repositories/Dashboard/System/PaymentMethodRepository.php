<?php
namespace App\Repositories\Dashboard\System;

use App\Models\PaymentMethod;
use App\Repositories\BaseRepository;

class PaymentMethodRepository extends BaseRepository{
    protected function model()
    {
        return PaymentMethod::class;
    }
}
