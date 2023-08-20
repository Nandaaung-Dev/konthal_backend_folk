<?php

namespace App\Repositories\Api\System\V1;


use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }
}
