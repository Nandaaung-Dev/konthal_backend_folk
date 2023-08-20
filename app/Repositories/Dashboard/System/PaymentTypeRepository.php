<?php
namespace App\Repositories\Dashboard\System;

use App\Models\PaymentType;
use App\Repositories\BaseRepository;

class PaymentTypeRepository extends BaseRepository{
    protected function model()
    {
        return PaymentType::class;
    }
}
