<?php

namespace App\Repositories\Api\System\V1;

use App\Models\Customer;
use App\Repositories\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function model()
    {
        return Customer::class;
    }
}
