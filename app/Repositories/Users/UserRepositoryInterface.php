<?php
namespace App\Repositories\Users;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function createUser($getInfo,$social);

    public function setPermission($id, $request);
}
