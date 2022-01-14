<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    public function newModel()
    {
        return new $this->model;
    }

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getPage($pageNumber = 10)
    {
        return $this->model->orderByDesc('updated_at')->paginate($pageNumber);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->findOrFail($id);
        return $result->update($attributes);
    }

    public function delete($id)
    {
        $result = $this->findOrFail($id);
        return $result->delete();
    }
}
