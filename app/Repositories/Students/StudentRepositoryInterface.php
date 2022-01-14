<?php
namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function createStudent($attributes);

    public function updateStudent($id, $attributes);

    public function deleteStudent($id);

    public function arrayIdName($array);

    public function arrGender();
}
