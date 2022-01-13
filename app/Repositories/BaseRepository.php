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

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function newModel()
    {
        return new $this->model;
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
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->findOrFail($id);

        return $result;
    }

    public function delete($id)
    {
        $result = $this->findOrFail($id);

        return $result;
    }
}
