<?php

namespace App\Repositories;

use App\Models\Guest;
use App\Repositories\Contracts\GuestRepositoryInterface;

class GuestRepository implements GuestRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Guest();
    }
    
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->model->findAll();
    }
    
    /**
     * getById
     *
     * @param  int $id
     * @return array
     */
    public function getById(int $id): ?array
    {
        $result = $this->model->find($id);
        return $result ? (array) $result : null;
    }
    
    /**
     * create
     *
     * @param  array $data
     * @return array
     */
    public function create(array $data): array
    {
        $this->model->insert($data);
        return $this->model->find($this->model->insertID());
    }
    
    /**
     * update
     *
     * @param  int $id
     * @param  array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}