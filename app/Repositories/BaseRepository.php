<?php

namespace App\Repositories;

use App\Repositories\RepositoryContract;
use App\Traits\Filterable;
use App\Traits\Paginatable;
use App\Traits\Relationable;

abstract class BaseRepository implements RepositoryContract
{
    use Paginatable, Relationable, Filterable;
    protected $model;

    private $query;
    public function __construct()
    {
        $this->makeModel();
    }

    abstract protected function model();

    private function makeModel()
    {
        $model = app()->make($this->model());
        return $this->model = $model;
    }
    private function newQuery()
    {
        $this->query = $this->model->newQuery();
        return $this;
    }

    public function all(array $columns = ['*'])
    {
        $this->newQuery();
        if (!empty($this->filters)) {
            $this->query->filter($this->filters);
        }
        if (isset($this->search)) {
            $this->query->search($this->search);
        }
        $this->query->with($this->relations);
        $models = $this->query->get($columns);
        return $models;
    }
    // public function paginate(array $columns = ['*'])
    // {
    //     $models = $this->model->filter($this->filters)->search($this->search)->with($this->relations)->paginate($this->pagination, $columns);
    //     return $models;
    // }
    public function paginate(array $columns = ['*'])
    {
        $this->newQuery();
        if (!empty($this->filters)) {
            $this->query->filter($this->filters);
        }
        if (isset($this->search)) {
            $this->query->search($this->search);
        }
        $this->query->with($this->relations);
        $this->query->orderBy($this->sortBy, $this->sortOrder);
        $models = $this->query->paginate($this->pagination, $columns);
        return $models;
    }
    public function create(array $data)
    {
        if (empty($data)) return false;
        $result = $this->model::create($data);
        // if ($result) return $result->refresh();
        // return false;
        return $result ? $result->refresh() : false;
    }
    public function findOrFail(int $primaryKey)
    {
        return $this->model::findOrFail($primaryKey);
    }
    public function update($intendedModel,array $data)
    {
        if ( empty($data)) return false;
        if ($intendedModel->update($data)) return $intendedModel->refresh();
        return false;
    }
    public function delete(int $id)
    {
        if (!$id) return false;
        return $this->findOrFail($id)->delete();
    }
    public function createMorph(object $createdBy) {
        // $result = $createdBy->
        // return $result ? $result->refresh() : false;
    }
}
