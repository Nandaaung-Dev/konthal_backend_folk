<?php

namespace App\Repositories;

interface RepositoryContract
{
    public function all(array $columns = ['*']);
    public function create(array $data);
    public function findOrFail(int $id);
    public function update(object $intendedModel,array $data);
    public function delete(int $id);
}
