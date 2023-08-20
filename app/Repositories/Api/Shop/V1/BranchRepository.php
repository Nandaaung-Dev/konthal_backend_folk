<?php

namespace App\Repositories\Api\Shop\V1;

use App\Models\Branch;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class BranchRepository extends BaseRepository
{
    public function model()
    {
        return Branch::class;
    }
    public function create(array $data)
    {
        $slug = Str::of($data['name'])->slug('-');
        $data['slug'] = $slug;
        return $this->create($data);
    }
    public function update($branch, array $data)
    {
        $data['updatable_id'] = auth()->user()->id;
        $data['updatable_type'] = class_basename(auth()->user());
         $branch->update($data);
         return $branch->refresh();
    }
}
