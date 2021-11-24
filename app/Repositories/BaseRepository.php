<?php

namespace App\Repositories;

abstract class BaseRepository
{

    protected $entity = null;

    public function all(string $sortBy = 'created_at', string $sortOrder = 'desc')
    {
        return $this->entity::orderBy($sortBy, $sortOrder)
            ->get();
    }

    public function paginated(int $paginate, string $sortBy = 'created_at', string $sortOrder = 'desc')
    {
        return $this->entity::orderBy($sortBy, $sortOrder)
            ->paginate($paginate);
    }

    public function create(array $data)
    {
        return $this->entity::create($data);
    }

    public function find( $id)
    {
        return $this->entity::findOrFail($id);
    }

    public function remove(int $id): bool
    {
        return $this->entity::findOrFail($id)->delete();
    }

    public function update(int $id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
        $model->save();

        return $model;
    }

}