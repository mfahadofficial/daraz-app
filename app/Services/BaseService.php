<?php

namespace App\Services;

abstract class BaseService
{

    public $repository;

    public function all(string $sortBy = 'created_at', string $sortOrder = 'desc')
    {
        return $this->repository->all($sortBy, $sortOrder);
    }

    public function paginated()
    {
        return $this->repository->paginated(10);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function remove(int $id)
    {
        return $this->repository->remove($id);
    }

}